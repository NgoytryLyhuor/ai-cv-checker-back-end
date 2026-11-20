<?php

declare(strict_types=1);

use App\Enums\CheckService;
use App\Enums\CheckStatus;
use App\Models\CheckRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('scrubs PII from expired check requests while keeping recent ones', function (): void {
    $expired = CheckRequest::create([
        'token' => '550e8400-e29b-41d4-a716-446655440011',
        'service' => CheckService::FULL,
        'email' => 'old@example.com',
        'text' => 'Sensitive CV content',
        'result_json' => ['score' => 65, 'label' => 'Fair', 'strengths' => [], 'weaknesses' => [], 'suggestions' => [], 'improved_cv' => 'x', 'translated_cv' => ''],
        'score' => 65,
        'status' => CheckStatus::COMPLETED,
        'consent_accepted_at' => now()->subDays(8),
        'expires_at' => now()->subHour(),
    ]);

    $active = CheckRequest::create([
        'token' => '550e8400-e29b-41d4-a716-446655440022',
        'service' => CheckService::REVIEW,
        'email' => 'new@example.com',
        'text' => 'Fresh CV content',
        'result_json' => ['score' => 80, 'label' => 'Good', 'strengths' => [], 'weaknesses' => [], 'suggestions' => [], 'improved_cv' => 'y', 'translated_cv' => ''],
        'score' => 80,
        'status' => CheckStatus::COMPLETED,
        'consent_accepted_at' => now(),
        'expires_at' => now()->addDays(6),
    ]);

    $this->artisan('checks:cleanup-expired')->assertSuccessful();

    $expired->refresh();
    $active->refresh();

    expect($expired->text)->toBeNull();
    expect($expired->result_json)->toBeNull();
    expect($expired->email)->toBeNull();
    expect($active->text)->toBe('Fresh CV content');
});

<?php

declare(strict_types=1);

use App\Enums\CheckService;
use App\Enums\CheckStatus;
use App\Models\CheckRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

it('returns health status', function (): void {
    $this->getJson('/api/v1/health')
        ->assertOk()
        ->assertJsonPath('data.status', 'ok');
});

it('returns sample report matching the contract', function (): void {
    $this->getJson('/api/v1/sample')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'token',
                'service',
                'status',
                'score',
                'label',
                'strengths',
                'weaknesses',
                'suggestions',
                'improved_cv',
                'translated_cv',
                'expires_at',
                'created_at',
            ],
        ]);
});

it('validates store check payload and returns 422 on invalid input', function (): void {
    $this->postJson('/api/v1/checks', [
        'text' => 'too short',
        'service' => 'invalid_service',
        'consent' => false,
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['text', 'service', 'consent']);
});

it('analyzes cv text with gemini and returns 201', function (): void {
    config()->set('services.gemini.key', 'test-key');
    config()->set('services.gemini.model', 'gemini-2.5-flash');

    $geminiPayload = [
        'score' => 78,
        'label' => 'Good',
        'strengths' => ['Clear structure', 'Quantified results', 'Good education'],
        'weaknesses' => ['Generic summary', 'Passive verbs', 'Missing skills section'],
        'suggestions' => ['Add target title', 'Use action verbs', 'Group skills'],
        'improved_cv' => 'Improved English CV content',
        'translated_cv' => 'ប្រវត្តិរូបសង្ខេបជាភាសាខ្មែរ',
    ];

    Http::fake([
        'generativelanguage.googleapis.com/*' => Http::response([
            'candidates' => [
                ['content' => ['parts' => [['text' => json_encode($geminiPayload)]]]],
            ],
        ], 200),
    ]);

    $cvText = str_repeat('Experienced software developer in Phnom Penh with Laravel and Vue.js skills. ', 3);

    $response = $this->postJson('/api/v1/checks', [
        'text' => $cvText,
        'service' => 'full',
        'consent' => true,
        'email' => 'user@example.com',
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.status', 'COMPLETED')
        ->assertJsonPath('data.score', 78)
        ->assertJsonPath('data.label', 'Good')
        ->assertJsonPath('data.improved_cv', 'Improved English CV content');

    $token = $response->json('data.token');

    $this->getJson("/api/v1/checks/{$token}")
        ->assertOk()
        ->assertJsonPath('data.token', $token)
        ->assertJsonPath('data.score', 78);
});

it('retries once on transient gemini error and marks FAILED if both fail', function (): void {
    config()->set('services.gemini.key', 'test-key');
    config()->set('services.gemini.fallback_models', []);

    Http::fake([
        'generativelanguage.googleapis.com/*' => Http::response(['error' => 'rate limited'], 429),
    ]);

    $cvText = str_repeat('Experienced accountant in Phnom Penh with NGO reporting experience. ', 3);

    $this->postJson('/api/v1/checks', [
        'text' => $cvText,
        'service' => 'review',
        'consent' => true,
    ])
        ->assertCreated()
        ->assertJsonPath('data.status', 'FAILED')
        ->assertJsonPath('data.score', null);

    Http::assertSentCount(2);
});

it('returns 404 for unknown token and 410 for expired token', function (): void {
    $this->getJson('/api/v1/checks/550e8400-e29b-41d4-a716-446655440000')
        ->assertNotFound();

    $expired = CheckRequest::create([
        'token' => '550e8400-e29b-41d4-a716-446655440099',
        'service' => CheckService::FULL,
        'text' => 'Old CV text',
        'result_json' => ['score' => 70, 'label' => 'Good', 'strengths' => [], 'weaknesses' => [], 'suggestions' => [], 'improved_cv' => 'x', 'translated_cv' => ''],
        'score' => 70,
        'status' => CheckStatus::COMPLETED,
        'consent_accepted_at' => now()->subDays(8),
        'expires_at' => now()->subDay(),
    ]);

    $this->getJson("/api/v1/checks/{$expired->token}")
        ->assertStatus(410)
        ->assertJsonPath('status', 'EXPIRED');
});

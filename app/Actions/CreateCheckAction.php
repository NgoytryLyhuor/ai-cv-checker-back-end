<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CheckService;
use App\Enums\CheckStatus;
use App\Models\CheckRequest;
use App\Services\GeminiService;
use Illuminate\Support\Str;
use Throwable;

/**
 * Executes AI CV analysis and persists the CheckRequest with a 7-day expiry.
 */
class CreateCheckAction
{
    public function __construct(private readonly GeminiService $gemini) {}

    /**
     * @param  array{text: string, service: string, email?: string|null}  $validated
     */
    public function execute(array $validated): CheckRequest
    {
        $service = CheckService::from($validated['service']);
        $token = (string) Str::uuid();
        $now = now();

        try {
            $analysis = $this->gemini->analyze($validated['text'], $service);

            return CheckRequest::create([
                'token' => $token,
                'service' => $service,
                'email' => $validated['email'] ?? null,
                'text' => $validated['text'],
                'result_json' => $analysis,
                'score' => $analysis['score'],
                'status' => CheckStatus::COMPLETED,
                'error_message' => null,
                'consent_accepted_at' => $now,
                'expires_at' => $now->copy()->addDays(7),
            ]);
        } catch (Throwable $e) {
            return CheckRequest::create([
                'token' => $token,
                'service' => $service,
                'email' => $validated['email'] ?? null,
                'text' => null,
                'result_json' => null,
                'score' => null,
                'status' => CheckStatus::FAILED,
                'error_message' => 'AI analysis is temporarily unavailable. Please try again.',
                'consent_accepted_at' => $now,
                'expires_at' => $now->copy()->addDays(7),
            ]);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\CheckRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CheckRequest
 */
class CheckResultResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var array<string, mixed> $result */
        $result = is_array($this->result_json) ? $this->result_json : [];

        return [
            'token' => $this->token,
            'service' => $this->service->value,
            'status' => $this->status->value,
            'score' => $this->score,
            'label' => $result['label'] ?? null,
            'strengths' => $result['strengths'] ?? [],
            'weaknesses' => $result['weaknesses'] ?? [],
            'suggestions' => $result['suggestions'] ?? [],
            'strengths_km' => $result['strengths_km'] ?? [],
            'weaknesses_km' => $result['weaknesses_km'] ?? [],
            'suggestions_km' => $result['suggestions_km'] ?? [],
            'improved_cv' => $result['improved_cv'] ?? null,
            'translated_cv' => $result['translated_cv'] ?? null,
            'structured_cv' => $result['structured_cv'] ?? null,
            'error_message' => $this->error_message,
            'expires_at' => $this->expires_at?->toIso8601ZuluString(),
            'created_at' => $this->created_at?->toIso8601ZuluString(),
        ];
    }
}

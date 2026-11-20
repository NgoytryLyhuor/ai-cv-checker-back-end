<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CheckService;
use App\Enums\CheckStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * Stores a CV check request and its encrypted AI result for 7 days.
 */
class CheckRequest extends Model
{
    protected $fillable = [
        'token',
        'service',
        'email',
        'text',
        'result_json',
        'score',
        'status',
        'error_message',
        'consent_accepted_at',
        'expires_at',
    ];

    protected $hidden = [
        'text',
        'email',
        'result_json',
    ];

    protected function casts(): array
    {
        return [
            'service' => CheckService::class,
            'status' => CheckStatus::class,
            'email' => 'encrypted',
            'text' => 'encrypted',
            'result_json' => 'encrypted:array',
            'score' => 'integer',
            'consent_accepted_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }
}

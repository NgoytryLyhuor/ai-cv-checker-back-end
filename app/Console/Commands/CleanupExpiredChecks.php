<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\CheckRequest;
use Illuminate\Console\Command;

/**
 * Scrubs PII (CV text, email, AI result) from expired records after 7 days.
 */
class CleanupExpiredChecks extends Command
{
    protected $signature = 'checks:cleanup-expired';

    protected $description = 'Purge PII from expired CV check requests older than 7 days';

    public function handle(): int
    {
        $count = CheckRequest::query()
            ->where('expires_at', '<=', now())
            ->where(function ($query): void {
                $query->whereNotNull('text')
                    ->orWhereNotNull('result_json')
                    ->orWhereNotNull('email');
            })
            ->update([
                'text' => null,
                'result_json' => null,
                'email' => null,
            ]);

        $this->info("Purged PII from {$count} expired check requests.");

        return self::SUCCESS;
    }
}

<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\CheckController;
use App\Http\Controllers\Api\V1\HealthController;
use App\Http\Controllers\Api\V1\SampleController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/health', HealthController::class);
    Route::get('/sample', [SampleController::class, 'show']);

    Route::post('/checks', [CheckController::class, 'store'])
        ->middleware('throttle:10,1');

    Route::get('/checks/{token}', [CheckController::class, 'show'])
        ->whereUuid('token');
});

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateCheckAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckRequest;
use App\Http\Resources\CheckResultResource;
use App\Models\CheckRequest;
use Illuminate\Http\JsonResponse;

class CheckController extends Controller
{
    public function store(StoreCheckRequest $request, CreateCheckAction $action): JsonResponse
    {
        $check = $action->execute($request->validated());

        return (new CheckResultResource($check))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $token): CheckResultResource|JsonResponse
    {
        $check = CheckRequest::where('token', $token)->firstOrFail();

        if ($check->isExpired() || $check->result_json === null && $check->status->value === 'COMPLETED') {
            return response()->json([
                'message' => 'This report has expired after 7 days.',
                'status' => 'EXPIRED',
            ], 410);
        }

        return new CheckResultResource($check);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CheckService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'min:100', 'max:50000'],
            'service' => ['required', Rule::enum(CheckService::class)],
            'consent' => ['required', 'accepted'],
            'email' => ['nullable', 'email', 'max:255'],
        ];
    }
}

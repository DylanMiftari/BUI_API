<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class DepositWithDrawResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "resources" => ["required", "array"],
            "resources.*.resourceId" => ["required", "integer", "exists:resource,id"],
            "resources.*.quantity" => ["required", "decimal:0,2"]
        ];
    }
}

<?php

namespace App\Http\Requests\Resource;

use App\Rules\AllResourcesExists;
use Illuminate\Foundation\Http\FormRequest;

class SellResourceRequest extends FormRequest
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
            "resources" => ["required", "array", new AllResourcesExists()],
            "resources.*.resource_id" => ["required", "integer"],
            "resources.*.quantity" => ["required", "decimal:0,2"]
        ];
    }
}

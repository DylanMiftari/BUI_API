<?php

namespace App\Http\Requests\Mine;

use App\Rules\MineCanProcessResource;
use Illuminate\Foundation\Http\FormRequest;

class MineProcessRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "resource_id" => ["required", "exists:resource,id", new MineCanProcessResource()]
        ];
    }
}

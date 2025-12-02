<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class CreditAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "amount" => ["required", "decimal:0,5"]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

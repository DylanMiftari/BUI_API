<?php

namespace App\Http\Requests\Bank\LoanRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequestRequest extends FormRequest
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
            "money" => ["filled", "decimal:0,2", "min:1"],
            "weeklyPayment" =>  ["filled", "decimal:0,2", "min:1"],
            "rate" => ["filled", "decimal:0,5", "min:0"],
            "description" => ["filled", "string"]
        ];
    }
}

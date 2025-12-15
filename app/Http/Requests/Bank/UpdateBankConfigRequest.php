<?php

namespace App\Http\Requests\Bank;

use App\Rules\Bank\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBankConfigRequest extends FormRequest
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
            "accountMaintenanceCost" => ["filled", "decimal:0,2", "min:0"],
            "transferCost" => ["filled", "decimal:0,5", "min:0"],
            "maxAccountMoney" => ["filled", "integer", "min:0", new MaxValueValidator("maxMoneyAccount")],
            "maxAccountResource" => ["filled", "decimal:0,2", "min:0", new MaxValueValidator("maxResourceAccount")],
        ];
    }
}

<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlackjackRequest extends FormRequest
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
            "blackJackWinMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "blackJackMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "blackJackMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("blackJackMaxBet")],
            "blackJackVIPWinMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "blackJackVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "blackJackVIPMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("blackJackMaxVIPBet")],
        ];
    }
}

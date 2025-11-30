<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiceRequest extends FormRequest
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
            "diceGoal" => ["filled", "integer", "min:0"],
            "diceWinMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "diceMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("diceMaxBet")],
            "diceVIPGoal" => ["filled", "integer", "min:0"],
            "diceVIPWinMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "diceVIPMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("diceMaxVIPBet")],
        ];
    }
}

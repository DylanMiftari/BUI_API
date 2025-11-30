<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePokerRequest extends FormRequest
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
            "nothingMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "onePairMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "twoPairMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "threeOfAKindMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "straightMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "flushMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "fullHouseMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "fourOfAKindMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "straightFlushMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "royalFlushMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "pokerMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("pokerMaxBet")],
            "nothingVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "onePairVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "twoPairVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "threeOfAKindVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "straightVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "flushVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "fullHouseVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "fourOfAKindVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "straightFlushVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "royalFlushVIPMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "pokerMaxVIPBet" => ["filled", "integer", "min:0", new MaxValueValidator("pokerMaxVIPBet")],
        ];
    }
}

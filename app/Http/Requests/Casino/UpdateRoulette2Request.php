<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoulette2Request extends FormRequest
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
            "roulette2StraigthUpMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2SplitMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2treetMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2CornerMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2SixLineMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2ColumnMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2DozenMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2OddEvenMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2RedBlackMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2MiddleMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2MaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("roulette2MaxBet")],
            "roulette2VIPStraigthUpMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPSplitMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPtreetMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPCornerMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPSixLineMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPColumnMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPDozenMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPOddEvenMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPRedBlackMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPMiddleMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "roulette2VIPMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("roulette2MaxVIPBet")],
        ];
    }
}

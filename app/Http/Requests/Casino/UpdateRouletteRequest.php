<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\MaxValueValidator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRouletteRequest extends FormRequest
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
            "rouletteSequenceMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "rouletteTripletMultiplcator" => ["filled", "decimal:0,5", "min:0"],
            "rouletteTripleSeventMultiplicator" =>  ["filled", "decimal:0,5", "min:0"],
            "rouletteMaxBet" => ["filled", "integer", "min:0", new MaxValueValidator("rouletteMaxBet")],
            "rouletteVIPSequenceMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "rouletteVIPTripletMultiplcator" => ["filled", "decimal:0,5", "min:0"],
            "rouletteVIPTripleSeventMultiplicator" => ["filled", "decimal:0,5", "min:0"],
            "rouletteMaxVIPBet" => ["filled", "integer", "min:0", new MaxValueValidator("rouletteMaxVIPBet")],
        ];
    }
}

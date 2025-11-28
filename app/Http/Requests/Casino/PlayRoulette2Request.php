<?php

namespace App\Http\Requests\Casino;

use App\Rules\Casino\Roulette2CornerValidator;
use App\Rules\Casino\Roulette2SixLineValidator;
use App\Rules\Casino\Roulette2SplitValidator;
use App\Rules\Casino\Roulette2StreetValidator;
use Illuminate\Foundation\Http\FormRequest;

class PlayRoulette2Request extends FormRequest
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
            "bet" => ["required", "array"],
            "bet.*" => ["array"],

            "bet.straight_up.*.bet" => ["decimal:0,2"],
            "bet.straight_up.*.number" => ["integer", "min:0", "max:36"],

            "bet.split.*.bet" => ["decimal:0,2"],
            "bet.split.*.numbers" => ["array", "size:2", new Roulette2SplitValidator()],
            "bet.split.*.numbers.*" => ["integer", "min:0", "max:36"],

            "bet.street.*.bet" => ["decimal:0,2"],
            "bet.street.*.numbers" => ["array", "size:3", new Roulette2StreetValidator()],
            "bet.street.*.numbers.*" => ["integer", "min:0", "max:36"],

            "bet.corner.*.bet" => ["decimal:0,2"],
            "bet.corner.*.numbers" => ["array", "size:4", new Roulette2CornerValidator()],
            "bet.corner.*.numbers.*" => ["integer", "min:0", "max:36"],

            "bet.sixline.*.bet" => ["decimal:0,2"],
            "bet.sixline.*.numbers" => ["array", "size:6", new Roulette2SixLineValidator()],
            "bet.sixline.*.numbers.*" => ["integer", "min:0", "max:36"],

            "bet.column.*.bet" => ["decimal:0,2"],
            "bet.column.*.column_number" => ["integer", "min:0", "max:2"],

            "bet.dozen.*.bet" => ["decimal:0,2"],
            "bet.dozen.*.dozen_number" => ["integer", "min:0", "max:2"],

            "bet.odd_even.*.bet" => ["decimal:0,2"],
            "bet.odd_even.*.bet_name" => ["string", "in:odd,even"],

            "bet.red_black.*.bet" => ["decimal:0,2"],
            "bet.red_black.*.bet_name" => ["string", "in:red,black"],

            "bet.middle.*.bet" => ["decimal:0,2"],
            "bet.middle.*.part_number" => ["integer", "min:0", "max:1"],
        ];
    }
}

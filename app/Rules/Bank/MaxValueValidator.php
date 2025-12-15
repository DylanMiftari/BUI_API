<?php

namespace App\Rules\Bank;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxValueValidator implements ValidationRule
{
    private string $field;
    public function __construct(string $field)
    {
        $this->field = $field;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bank = request()->route()->parameter('bank');
        $field = $this->field;
        $maxValue = $bank->bankLevel->$field;
        if($value > $maxValue) {
            $fail("Max value is {$maxValue} for the field $attribute");
        }
    }
}

<?php

namespace App\Rules\Casino;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Roulette2SplitValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $number1 = min($value);
        $number2 = max($value);

        if($number1+1 === $number2 && $number1%3 !== 0) {
            return;
        }
        // Si number1 et 34, 45 ou 36 alors number2 > 36 pour remplir la condition donc échoue avant d'arriver ici
        if($number1+3 === $number2) {
            return;
        }
        if($number1 === 0 && in_array($number2, [1, 2, 3])) {
            return;
        }

        $fail("Your split is not a valid split");
    }
}

<?php

namespace App\Rules\Casino;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class Roulette2SixLineValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sortedValues = array_values(Arr::sort($value));
        if(
            $this->checkIfAllValuesAreConsecutive($sortedValues) &&
            $sortedValues[0]%3 === 1 && $sortedValues[3]%3 === 1 &&
            $sortedValues[1]%3 === 2 && $sortedValues[4]%3 === 2 &&
            $sortedValues[2]%3 === 0 && $sortedValues[5]%3 === 0
        ) {
            return;
        }

        $fail("Your sixline is not a valid sixline");
    }

    private function checkIfAllValuesAreConsecutive(array $value): bool {
        $lastValue = $value[0];
        for($i = 1; $i < count($value); $i++) {
            if($value[$i] !== $lastValue+1) {
                return false;
            }
            $lastValue = $value[$i];
        }
        return true;
    }
}

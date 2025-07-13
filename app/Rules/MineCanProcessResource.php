<?php

namespace App\Rules;

use App\Models\Resource;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MineCanProcessResource implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mine = request()->route()->parameter("mine");
        $resource = Resource::findOrFail($value);
        if($resource->levelToMine === null) {
            $fail("This resource can't be mined by a mine");
        }
        if((int)$resource->levelToMine > (int)$mine->level) {
            $fail("This mine does not have enough level to mine this resource");
        }
    }
}

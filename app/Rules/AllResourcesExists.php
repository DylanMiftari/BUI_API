<?php

namespace App\Rules;

use App\Models\Resource;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllResourcesExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $resourceIds = array_map(fn($r) => $r["resource_id"], $value);
        $resourceCount = Resource::whereIn("id", $resourceIds)->count();

        if(count($resourceIds) !== $resourceCount) {
            $fail("A resource doesn't exist");
        }
    }
}

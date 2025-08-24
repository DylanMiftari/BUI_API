<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public $table = "city";
    public $timestamps = false;

    public function companies(): HasMany {
        return $this->hasMany(Company::class, "cityId", "id");
    }
}

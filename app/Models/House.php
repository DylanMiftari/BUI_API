<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class House extends Model
{
    public $table = "house";

    public $fillable = [
        "houseTypeId",
        "cityId"
    ];

    public function home(): HasOne {
        return $this->hasOne(Home::class, "houseId", "id");
    }
}

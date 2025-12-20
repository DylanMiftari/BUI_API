<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Home extends Model
{
    public $table = "home";

    public $fillable = [
        "houseId",
        "userId"
    ];

    public function house(): HasOne {
        return $this->hasOne(House::class, "id", "houseId");
    }
}

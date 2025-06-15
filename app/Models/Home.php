<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public $table = "home";

    public $fillable = [
        "houseId",
        "userId"
    ];
}

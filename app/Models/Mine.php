<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mine extends Model
{
    public $table = "mine";

    public $fillable = [
        "userId"
    ];
}

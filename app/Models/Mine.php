<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mine extends Model
{
    public $table = "mine";

    public $fillable = [
        "userId"
    ];

    public function resource(): HasOne {
        return $this->hasOne(Resource::class, "id", "currentTargetResourceId");
    }
}

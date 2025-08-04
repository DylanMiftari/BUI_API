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

    protected $casts = [
        "startedAt" => "datetime"
    ];

    public function resource(): HasOne {
        return $this->hasOne(Resource::class, "id", "currentTargetResourceId");
    }

    public function mineLevel(): HasOne {
        return $this->hasOne(MineLevel::class, "level", "level");
    }

    public function upgrade() {
        $this->level++;
        $this->save();
    }
}

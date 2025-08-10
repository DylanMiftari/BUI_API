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

    public function getHourlyIncome() {
        if($this->currentTargetResourceId === null) {
            return 0;
        }
        $resource = $this->resource;
        $totalPrice = $resource->marketPrice * 10 * $resource->mineQuantity;
        return round($totalPrice / ($resource->timeToMine / 60), 2);
    }

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

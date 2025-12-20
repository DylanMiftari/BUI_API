<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Thiagoprz\CompositeKey\HasCompositeKey;

class UserResource extends Model
{
    use HasCompositeKey;

    protected $primaryKey = ["userId", "resourceId"];
    protected $table = "userresource";
    public $timestamps = false;

    protected $fillable = [
        "userId",
        "resourceId",
        "quantity"
    ];

    public function resource(): HasOne {
        return $this->hasOne(Resource::class, "id", "resourceId");
    }
}

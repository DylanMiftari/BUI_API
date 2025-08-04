<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class UserResource extends Model
{
    use HasCompositeKey;
    
    protected $primaryKey = ["userId", "resourceId"];
    protected $table = "userresource";
    public $timestamps = false;
}

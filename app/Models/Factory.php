<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $table = "factory";
    protected $fillable = ["companyId"];
}

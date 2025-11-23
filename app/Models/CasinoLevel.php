<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasinoLevel extends Model
{
    public $timestamps = false;
    protected $table = 'casinolevel';
    protected $primaryKey = "level";
}

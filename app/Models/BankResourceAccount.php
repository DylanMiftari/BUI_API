<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class BankResourceAccount extends Model
{
    use HasCompositeKey;
    public $primaryKey = ["bankAccountId", "resourceId"];
    public $timestamps = false;

    protected $table = 'bankresourceaccount';

    protected $fillable = [
        'bankAccountId',
        'resourceId',
        'quantity',
    ];
}

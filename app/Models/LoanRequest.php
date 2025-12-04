<?php

namespace App\Models;

use App\Enums\LoanRequestStatus;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    protected $table = 'creditrequest';

    protected $fillable = [
        'status',
        'money',
        'weeklypayment',
        'alreadyPayed',
        'rate',
        'description',
        'userId',
        'bankId',
    ];

    protected $casts = [
        'status' => LoanRequestStatus::class,
    ];
}

<?php

namespace App\Models;

use App\Enums\LoanRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function bank(): HasOne {
        return $this->hasOne(Bank::class, 'id', 'bankId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bankaccount';

    protected $fillable = [
        'accountMaintenanceCost',
        'transferCost',
        'money',
        'maxMoney',
        'maxResource',
        'bankId',
        'userId',
        'isEnable',
    ];

    protected function casts(): array
    {
        return [
            'isEnable' => 'boolean',
        ];
    }
}

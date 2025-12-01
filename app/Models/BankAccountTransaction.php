<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccountTransaction extends Model
{
    protected $table = 'bankaccounttransaction';

    protected $fillable = [
        'money',
        'description',
        'bankAccountId',
        'transfert_cost',
        'isCredit',
    ];

    protected function casts(): array
    {
        return [
            'isCredit' => 'boolean',
        ];
    }
}

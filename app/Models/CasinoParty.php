<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasinoParty extends Model
{
    protected $table = 'casinoparty';

    protected $fillable = [
        'gameName',
        'bet',
        'winnings',
        'casinoId',
        'userId',
    ];
}

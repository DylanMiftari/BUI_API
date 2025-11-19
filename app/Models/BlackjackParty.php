<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlackjackParty extends Model
{
    protected $table = 'blackjack_party';

    protected $fillable = [
        'casinoId',
        'userId',
        'userHand',
        'bankHand',
        'bet',
        'cardPack',
    ];

    protected function casts(): array
    {
        return [
            'userHand' => 'array',
            'bankHand' => 'array',
            'cardPack' => 'array',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function casino(): HasOne {
        return $this->hasOne(Casino::class, 'id', 'casinoId');
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}

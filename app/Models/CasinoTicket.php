<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CasinoTicket extends Model
{
    protected $table = 'casinoticket';

    protected $fillable = [
        'isVIP',
        'casinoId',
        'userId',
    ];

    protected function casts(): array
    {
        return [
            'isVIP' => 'boolean',
        ];
    }

    public function isExpired() {
        $expirationDate = $this->created_at->addDays(config("casino.ticket-lifetime-days"));
        return $expirationDate < now();
    }

    public function casino(): HasOne {
        return $this->hasOne(Casino::class, "id", "casinoId");
    }
}

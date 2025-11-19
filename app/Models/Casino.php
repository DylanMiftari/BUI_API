<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Casino extends Model
{
    protected $table = "casino";
    protected $fillable = ["companyId"];

    public function getTicketPrice(bool $isVIP): float {
        return $isVIP ? $this->VIPTicketPrice : $this->ticketPrice;
    }

    public function company(): HasOne {
        return $this->hasOne(Company::class, 'id', 'companyId');
    }

    public function getMaxBetForGame(string $game, bool $isVIP = false): float {
        switch ($game) {
            case "roulette":
                return $isVIP ? $this->rouletteMaxVIPBet : $this->rouletteMaxBet;
            case "dice":
                return $isVIP ? $this->diceVIPMaxBet : $this->diceMaxBet;
            case "poker":
                return $isVIP ? $this->pokerMaxVIPBet : $this->pokerMaxBet;
            case "blackjack":
                return $isVIP ? $this->blackJackVIPMaxBet : $this->blackJackMaxBet;
            case "roulette2":
                return $isVIP ? $this->roulette2VIPMaxBet : $this->roulette2MaxBet;
        }
        return 0;
    }
}

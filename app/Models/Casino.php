<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

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

    public function tickets(): HasMany {
        return $this->hasMany(CasinoTicket::class, 'casinoId', 'id');
    }

    public function casinoLevel(): HasOne {
        return $this->hasOne(CasinoLevel::class, 'level', 'level');
    }

    public function activeTickets(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->tickets()
            ->where("created_at", ">=", Carbon::now()->subDays(config("casino.ticket-lifetime-days")))
            ->get();
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

    public function getActiveTicketsCount(): int {
        return $this->activeTickets()->where("isVIP", 0)->count();
    }
    public function getActiveVIPTicketsCount(): int {
        return $this->activeTickets()->where("isVIP", 1)->count();
    }
}

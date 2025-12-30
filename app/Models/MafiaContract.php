<?php

namespace App\Models;

use App\Enums\MafiaContractStatus;
use App\Enums\MafiaTargetType;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\MinimalBankAccountResource;
use Illuminate\Database\Eloquent\Model;

class MafiaContract extends Model
{
    protected $table = 'mafiacontract';

    protected $fillable = [
        'clientPrice',
        'secondPrice',
        'robDate',
        'robState',
        'userId',
        'mafiaId',
        'targetType',
        'targetId',
        'robSuccess',
        'robWinnings',
        'robCost',
    ];

    protected function casts(): array
    {
        return [
            'robDate' => 'datetime',
            "targetType" => MafiaTargetType::class,
            "robState" => MafiaContractStatus::class
        ];
    }

    public function target()
    {
        return $this->morphTo('target', 'targetType', 'targetId');
    }

    public function targetResource() {
        $target = $this->target;
        return match($this->targetType) {
            MafiaTargetType::USER, MafiaTargetType::USER_DRONE => new UserResource($target),
            MafiaTargetType::COMPANY, MafiaTargetType::CYBERATTACK, MafiaTargetType::SHOPLIFTING => new CompanyResource($target),
            MafiaTargetType::BANK_ACCOUNT, MafiaTargetType::PHISHING => new MinimalBankAccountResource($target),
            MafiaTargetType::HOME, MafiaTargetType::HOME_DRONE => new HomeResource($target),
        };
    }
}

<?php

namespace App\Models;

use App\Enums\MafiaContractStatus;
use App\Enums\MafiaTargetType;
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
}

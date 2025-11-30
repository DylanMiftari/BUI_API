<?php

namespace App\Http\Actions\Casino;

use App\Models\Casino;
use App\Models\CasinoLevel;
use Illuminate\Support\Facades\DB;

class GetCasinoDashboardAction
{
    public function handle(Casino $casino): array
    {
        $casino->load(['company', 'casinoLevel']);

        $nextLevel = $casino->level + 1;
        $priceForNextLevel = config("company.company_upgrade_cost.$nextLevel");

        return [
            "casino" => $casino,
            "nextLevelPrice" => $priceForNextLevel,
            "levels" => CasinoLevel::all()
        ];
    }
}

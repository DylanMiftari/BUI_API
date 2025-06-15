<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecurityCompanyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("securitycompanylevel")->insert([
            [
                "level" => 1,
                "resourceSafeCapacity" => 5,
                "hasAlarm" => true,
                "hasPepperSpray" => true,
                "hasGasDispenser" => false,
                "hasReinforcedDoor" => false,
                "hasBodyGuard" => false,
                "hasSecurityGuard" => false,
                "hasCyberDefense" => false,
                "hasAntiAISystem" => false,
                "hasContainmentSystem" => false,
                "distance_multiplicator" => null,
            ],
            [
                "level" => 2,
                "resourceSafeCapacity" => 10,
                "hasAlarm" => true,
                "hasPepperSpray" => true,
                "hasGasDispenser" => true,
                "hasReinforcedDoor" => true,
                "hasBodyGuard" => false,
                "hasSecurityGuard" => false,
                "hasCyberDefense" => false,
                "hasAntiAISystem" => false,
                "hasContainmentSystem" => false,
                "distance_multiplicator" => 2,
            ],
            [
                "level" => 3,
                "resourceSafeCapacity" => 15,
                "hasAlarm" => true,
                "hasPepperSpray" => true,
                "hasGasDispenser" => true,
                "hasReinforcedDoor" => true,
                "hasBodyGuard" => true,
                "hasSecurityGuard" => true,
                "hasCyberDefense" => false,
                "hasAntiAISystem" => false,
                "hasContainmentSystem" => false,
                "distance_multiplicator" => 2,
            ],
            [
                "level" => 4,
                "resourceSafeCapacity" => 20,
                "hasAlarm" => true,
                "hasPepperSpray" => true,
                "hasGasDispenser" => true,
                "hasReinforcedDoor" => true,
                "hasBodyGuard" => true,
                "hasSecurityGuard" => true,
                "hasCyberDefense" => true,
                "hasAntiAISystem" => false,
                "hasContainmentSystem" => false,
                "distance_multiplicator" => 1.7,
            ],
            [
                "level" => 5,
                "resourceSafeCapacity" => 25,
                "hasAlarm" => true,
                "hasPepperSpray" => true,
                "hasGasDispenser" => true,
                "hasReinforcedDoor" => true,
                "hasBodyGuard" => true,
                "hasSecurityGuard" => true,
                "hasCyberDefense" => true,
                "hasAntiAISystem" => true,
                "hasContainmentSystem" => false,
                "distance_multiplicator" => 1.5,
            ],
            [
                "level" => 6,
                "resourceSafeCapacity" => 30,
                "hasAlarm" => true,
                "hasPepperSpray" => true,
                "hasGasDispenser" => true,
                "hasReinforcedDoor" => true,
                "hasBodyGuard" => true,
                "hasSecurityGuard" => true,
                "hasCyberDefense" => true,
                "hasAntiAISystem" => true,
                "hasContainmentSystem" => true,
                "distance_multiplicator" => 1.2,
            ],
        ]);
    }
}

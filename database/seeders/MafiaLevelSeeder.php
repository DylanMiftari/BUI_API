<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MafiaLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("mafialevel")->insert([
            [
                "level" => 1,
                "playerRobPrice" => 2_000,
                "companyRobPrice" => 10_000,
                "bankAccountRobPrice" => 5_000,
                "homeSafeRobPrice" => 500
            ],
            [
                "level" => 2,
                "playerRobPrice" => 4_000,
                "companyRobPrice" => 45_000,
                "bankAccountRobPrice" => 7_500,
                "homeSafeRobPrice" => 750
            ],
            [
                "level" => 3,
                "playerRobPrice" => 6_000,
                "companyRobPrice" => 80_000,
                "bankAccountRobPrice" => 10_000,
                "homeSafeRobPrice" => 1_000
            ],
            [
                "level" => 4,
                "playerRobPrice" => 10_000,
                "companyRobPrice" => 225_000,
                "bankAccountRobPrice" => 20_000,
                "homeSafeRobPrice" => 1_500
            ],
            [
                "level" => 5,
                "playerRobPrice" => 12_500,
                "companyRobPrice" => 850_000,
                "bankAccountRobPrice" => 50_000,
                "homeSafeRobPrice" => 2_000
            ],
            [
                "level" => 6,
                "playerRobPrice" => 15_000,
                "companyRobPrice" => 1_500_000,
                "bankAccountRobPrice" => 85_000,
                "homeSafeRobPrice" => 2_250
            ],
        ]);
    }
}

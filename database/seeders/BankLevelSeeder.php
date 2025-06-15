<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("banklevel")->insert([
            [
                "level" => 1,
                "maxMoneyAccount" => 100_000,
                "maxResourceAccount" => 20,
                "maxNbAccount" =>  10
            ],
            [
                "level" => 2,
                "maxMoneyAccount" => 500_000,
                "maxResourceAccount" => 50,
                "maxNbAccount" =>  60
            ],
            [
                "level" => 3,
                "maxMoneyAccount" => 1_000_000,
                "maxResourceAccount" => 115,
                "maxNbAccount" =>  200
            ],
            [
                "level" => 4,
                "maxMoneyAccount" => 50_000_000,
                "maxResourceAccount" => 200,
                "maxNbAccount" =>  1000
            ],
            [
                "level" => 5,
                "maxMoneyAccount" => 500_000_000,
                "maxResourceAccount" => 425,
                "maxNbAccount" =>  5000
            ],
            [
                "level" => 6,
                "maxMoneyAccount" => 5_000_000_000,
                "maxResourceAccount" => 1000,
                "maxNbAccount" =>  35000
            ],
        ]);
    }
}

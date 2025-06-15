<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasinoLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("casinolevel")->insert([
            [
                "level" => 1,
                "nbMaxTicket" => 10,
                "maxTicketPrice" => 150,
                "nbMaxVIPTicket" => 0,
                "maxVIPTicketPrice" => null,
                "maxSuiteRent" => null,
                "nbMaxSuite" => 0,

                "rouletteMaxBet" => 500,
                "rouletteMaxVIPBet" => null,
                "rouletteMaxUltraVIPBet" => null,

                "diceMaxBet" => null,
                "diceMaxVIPBet" => null,
                "diceMaxUltraVIPBet" => null,

                "pokerMaxBet" => null,
                "pokerMaxVIPBet" => null,
                "pokerMaxUltraVIPBet" => null,

                "blackJackMaxBet" => null,
                "blackJackMaxVIPBet" => null,
                "blackJackMaxUltraVIPBet" => null,

                "roulette2MaxBet" => null,
                "roulette2MaxVIPBet" => null,
                "roulette2MaxUltraVIPBet" => null,
            ],
            [
                "level" => 2,
                "nbMaxTicket" => 50,
                "maxTicketPrice" => 350,
                "nbMaxVIPTicket" => 0,
                "maxVIPTicketPrice" => null,
                "maxSuiteRent" => null,
                "nbMaxSuite" => 0,

                "rouletteMaxBet" => 1500,
                "rouletteMaxVIPBet" => null,
                "rouletteMaxUltraVIPBet" => null,

                "diceMaxBet" => 750,
                "diceMaxVIPBet" => null,
                "diceMaxUltraVIPBet" => null,

                "pokerMaxBet" => null,
                "pokerMaxVIPBet" => null,
                "pokerMaxUltraVIPBet" => null,

                "blackJackMaxBet" => null,
                "blackJackMaxVIPBet" => null,
                "blackJackMaxUltraVIPBet" => null,

                "roulette2MaxBet" => null,
                "roulette2MaxVIPBet" => null,
                "roulette2MaxUltraVIPBet" => null,
            ],
            [
                "level" => 3,
                "nbMaxTicket" => 150,
                "maxTicketPrice" => 650,
                "nbMaxVIPTicket" => 1,
                "maxVIPTicketPrice" => 15_000,
                "maxSuiteRent" => null,
                "nbMaxSuite" => 0,

                "rouletteMaxBet" => 2_500,
                "rouletteMaxVIPBet" => 8_000,
                "rouletteMaxUltraVIPBet" => null,

                "diceMaxBet" => 2_000,
                "diceMaxVIPBet" => 8_000,
                "diceMaxUltraVIPBet" => null,

                "pokerMaxBet" => 5_000,
                "pokerMaxVIPBet" => 30_000,
                "pokerMaxUltraVIPBet" => null,

                "blackJackMaxBet" => null,
                "blackJackMaxVIPBet" => null,
                "blackJackMaxUltraVIPBet" => null,

                "roulette2MaxBet" => null,
                "roulette2MaxVIPBet" => null,
                "roulette2MaxUltraVIPBet" => null,
            ],
            [
                "level" => 4,
                "nbMaxTicket" => 300,
                "maxTicketPrice" => 1_500,
                "nbMaxVIPTicket" => 15,
                "maxVIPTicketPrice" => 35_000,
                "maxSuiteRent" => 350_000,
                "nbMaxSuite" => 3,

                "rouletteMaxBet" => 4_000,
                "rouletteMaxVIPBet" => 12_500,
                "rouletteMaxUltraVIPBet" => 50_000,

                "diceMaxBet" => 3_750,
                "diceMaxVIPBet" => 12_500,
                "diceMaxUltraVIPBet" => 50_000,

                "pokerMaxBet" => 15_000,
                "pokerMaxVIPBet" => 50_000,
                "pokerMaxUltraVIPBet" => 150_000,

                "blackJackMaxBet" => 12_500,
                "blackJackMaxVIPBet" => 75_000,
                "blackJackMaxUltraVIPBet" => 200_000,

                "roulette2MaxBet" => null,
                "roulette2MaxVIPBet" => null,
                "roulette2MaxUltraVIPBet" => null,
            ],
            [
                "level" => 5,
                "nbMaxTicket" => 1_750,
                "maxTicketPrice" => 3_000,
                "nbMaxVIPTicket" => 50,
                "maxVIPTicketPrice" => 65_000,
                "maxSuiteRent" => 1_000_000,
                "nbMaxSuite" => 5,

                "rouletteMaxBet" => 5_000,
                "rouletteMaxVIPBet" => 17_500,
                "rouletteMaxUltraVIPBet" => 100_000,

                "diceMaxBet" => 6_500,
                "diceMaxVIPBet" => 17_500,
                "diceMaxUltraVIPBet" => 100_000,

                "pokerMaxBet" => 25_000,
                "pokerMaxVIPBet" => 80_000,
                "pokerMaxUltraVIPBet" => 400_000,

                "blackJackMaxBet" => 30_000,
                "blackJackMaxVIPBet" => 100_000,
                "blackJackMaxUltraVIPBet" => 500_000,

                "roulette2MaxBet" => 50_000,
                "roulette2MaxVIPBet" => 150_000,
                "roulette2MaxUltraVIPBet" => 625_000,
            ],
            [
                "level" => 6,
                "nbMaxTicket" => null,
                "maxTicketPrice" => 35_000,
                "nbMaxVIPTicket" => 750,
                "maxVIPTicketPrice" => 650_000,
                "maxSuiteRent" => 130_000_000,
                "nbMaxSuite" => 15,

                "rouletteMaxBet" => 10_000,
                "rouletteMaxVIPBet" => 42_500,
                "rouletteMaxUltraVIPBet" => 250_000,

                "diceMaxBet" => 12_000,
                "diceMaxVIPBet" => 42_500,
                "diceMaxUltraVIPBet" => 250_000,

                "pokerMaxBet" => 100_000,
                "pokerMaxVIPBet" => 250_000,
                "pokerMaxUltraVIPBet" => 1_000_000,

                "blackJackMaxBet" => 150_000,
                "blackJackMaxVIPBet" => 300_000,
                "blackJackMaxUltraVIPBet" => 2_000_000,

                "roulette2MaxBet" => 200_000,
                "roulette2MaxVIPBet" => 400_000,
                "roulette2MaxUltraVIPBet" => 2_000_000,
            ],
        ]);
    }
}

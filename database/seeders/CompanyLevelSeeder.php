<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("companylevel")->insert([
            [
                "level" => 1,
                "priceForNextLevel" => 20_000
            ],
            [
                "level" => 2,
                "priceForNextLevel" => 50_000
            ],
            [
                "level" => 3,
                "priceForNextLevel" => 300_000
            ],
            [
                "level" => 4,
                "priceForNextLevel" => 1_000_000
            ],
            [
                "level" => 5,
                "priceForNextLevel" => 5_000_000
            ],
            [
                "level" => 6,
                "priceForNextLevel" => null
            ],
        ]);
    }
}

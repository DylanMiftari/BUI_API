<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstateAgencyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("estateagencylevel")->insert([
            [
                "level" => 1,
                "maxNbLocation" => 3
            ],
            [
                "level" => 2,
                "maxNbLocation" => 7
            ],
            [
                "level" => 3,
                "maxNbLocation" => 12
            ],
            [
                "level" => 4,
                "maxNbLocation" => 15
            ],
            [
                "level" => 5,
                "maxNbLocation" => 25
            ],
            [
                "level" => 6,
                "maxNbLocation" => 50
            ],
        ]);
    }
}

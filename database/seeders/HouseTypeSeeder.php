<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("housetype")->insert([
            [
                "id" => 1,
                "typeName" => "Tipi",
                "constructionDuration" => 0,
                "constructionCost" => 0,
                "maintenanceCost" => 50
            ],
            [
                "id" => 2,
                "typeName" => "Yourte",
                "constructionDuration" => 5,
                "constructionCost" => 750,
                "maintenanceCost" => 150
            ],
            [
                "id" => 3,
                "typeName" => "Appartement",
                "constructionDuration" => 15,
                "constructionCost" => 50_000,
                "maintenanceCost" => 3_000
            ],
            [
                "id" => 4,
                "typeName" => "Maison",
                "constructionDuration" => 30,
                "constructionCost" => 150_000,
                "maintenanceCost" => 8_000
            ],
            [
                "id" => 5,
                "typeName" => "Villa",
                "constructionDuration" => 50,
                "constructionCost" => 325_000,
                "maintenanceCost" => 20_000
            ],
        ]);
    }
}

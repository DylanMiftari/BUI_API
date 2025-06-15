<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactoryLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("factorylevel")->insert([
            [
                "level" => 1,
                "nbMachine" => 1,
                "nbSellSlot" => 5,
                "quantityPerSlot" => 1,
                "warehouseCapacity" => 35,
                "distanceSellingMultiplicator" => null
            ],
            [
                "level" => 2,
                "nbMachine" => 3,
                "nbSellSlot" => 10,
                "quantityPerSlot" => 3,
                "warehouseCapacity" => 60,
                "distanceSellingMultiplicator" => null
            ],
            [
                "level" => 3,
                "nbMachine" => 5,
                "nbSellSlot" => 20,
                "quantityPerSlot" => 6,
                "warehouseCapacity" => 100,
                "distanceSellingMultiplicator" => null
            ],
            [
                "level" => 4,
                "nbMachine" => 5,
                "nbSellSlot" => 25,
                "quantityPerSlot" => 7.5,
                "warehouseCapacity" => 100,
                "distanceSellingMultiplicator" => 2
            ],
            [
                "level" => 5,
                "nbMachine" => 10,
                "nbSellSlot" => 40,
                "quantityPerSlot" => 15,
                "warehouseCapacity" => 150,
                "distanceSellingMultiplicator" => 1.75
            ],
            [
                "level" => 6,
                "nbMachine" => 25,
                "nbSellSlot" => 60,
                "quantityPerSlot" => 35,
                "warehouseCapacity" => 250,
                "distanceSellingMultiplicator" => 1.25
            ]
        ]);
    }
}

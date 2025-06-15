<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseTypeResourceCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("housetyperesourcecost")->insert([
            [
                "houseTypeId" => 2,
                "resourceId" => 23,
                "quantity" => 5,
            ],
            [
                "houseTypeId" => 2,
                "resourceId" => 5,
                "quantity" => 2,
            ],


            [
                "houseTypeId" => 3,
                "resourceId" => 25,
                "quantity" => 30,
            ],
            [
                "houseTypeId" => 3,
                "resourceId" => 20,
                "quantity" => 5,
            ],
            [
                "houseTypeId" => 3,
                "resourceId" => 5,
                "quantity" => 2,
            ],


            [
                "houseTypeId" => 4,
                "resourceId" => 30,
                "quantity" => 65,
            ],
            [
                "houseTypeId" => 4,
                "resourceId" => 16,
                "quantity" => 10,
            ],
            [
                "houseTypeId" => 4,
                "resourceId" => 5,
                "quantity" => 5,
            ],
            [
                "houseTypeId" => 4,
                "resourceId" => 18,
                "quantity" => 2,
            ],


            [
                "houseTypeId" => 5,
                "resourceId" => 30,
                "quantity" => 105,
            ],
            [
                "houseTypeId" => 5,
                "resourceId" => 9,
                "quantity" => 10,
            ],
            [
                "houseTypeId" => 5,
                "resourceId" => 24,
                "quantity" => 15,
            ],
            [
                "houseTypeId" => 5,
                "resourceId" => 18,
                "quantity" => 20,
            ],
            [
                "houseTypeId" => 5,
                "resourceId" => 26,
                "quantity" => 25,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstateCanConstructSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("estatecanconstruct")->insert([
            [
                "estateAgencyLevel" => 1,
                "houseTypeId" => 2
            ],


            [
                "estateAgencyLevel" => 2,
                "houseTypeId" => 2
            ],
            [
                "estateAgencyLevel" => 2,
                "houseTypeId" => 3
            ],


            [
                "estateAgencyLevel" => 3,
                "houseTypeId" => 2
            ],
            [
                "estateAgencyLevel" => 3,
                "houseTypeId" => 3
            ],
            [
                "estateAgencyLevel" => 3,
                "houseTypeId" => 4
            ],


            [
                "estateAgencyLevel" => 4,
                "houseTypeId" => 2
            ],
            [
                "estateAgencyLevel" => 4,
                "houseTypeId" => 3
            ],
            [
                "estateAgencyLevel" => 4,
                "houseTypeId" => 4
            ],
            [
                "estateAgencyLevel" => 4,
                "houseTypeId" => 5
            ],


            [
                "estateAgencyLevel" => 5,
                "houseTypeId" => 2
            ],
            [
                "estateAgencyLevel" => 5,
                "houseTypeId" => 3
            ],
            [
                "estateAgencyLevel" => 5,
                "houseTypeId" => 4
            ],
            [
                "estateAgencyLevel" => 5,
                "houseTypeId" => 5
            ],


            [
                "estateAgencyLevel" => 6,
                "houseTypeId" => 2
            ],
            [
                "estateAgencyLevel" => 6,
                "houseTypeId" => 3
            ],
            [
                "estateAgencyLevel" => 6,
                "houseTypeId" => 4
            ],
            [
                "estateAgencyLevel" => 6,
                "houseTypeId" => 5
            ],
        ]);
    }
}

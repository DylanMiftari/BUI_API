<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("recipe")->insert([
            [
                "id" => 1,
                "creationTime" => 60,
                "createdQuantity" => 1.0,
                "createdResourceId" => 18,
            ],
            [
                "id" => 2,
                "creationTime" => 360,
                "createdQuantity" => 1.0,
                "createdResourceId" => 19,
            ],
            [
                "id" => 3,
                "creationTime" => 180,
                "createdQuantity" => 1.0,
                "createdResourceId" => 20,
            ],
            [
                "id" => 4,
                "creationTime" => 240,
                "createdQuantity" => 4.0,
                "createdResourceId" => 21,
            ],
            [
                "id" => 5,
                "creationTime" => 150,
                "createdQuantity" => 1.0,
                "createdResourceId" => 22,
            ],
            [
                "id" => 6,
                "creationTime" => 90,
                "createdQuantity" => 1.0,
                "createdResourceId" => 23,
            ],
            [
                "id" => 7,
                "creationTime" => 180,
                "createdQuantity" => 1.0,
                "createdResourceId" => 24,
            ],
            [
                "id" => 8,
                "creationTime" => 390,
                "createdQuantity" => 1.0,
                "createdResourceId" => 25,
            ],
            [
                "id" => 9,
                "creationTime" => 120,
                "createdQuantity" => 1.0,
                "createdResourceId" => 26,
            ],
            [
                "id" => 10,
                "creationTime" => 480,
                "createdQuantity" => 1.0,
                "createdResourceId" => 27,
            ],
            [
                "id" => 11,
                "creationTime" => 450,
                "createdQuantity" => 0.5,
                "createdResourceId" => 28,
            ],
            [
                "id" => 12,
                "creationTime" => 600,
                "createdQuantity" => 1.0,
                "createdResourceId" => 29,
            ],
            [
                "id" => 13,
                "creationTime" => 150,
                "createdQuantity" => 1.0,
                "createdResourceId" => 30,
            ],
            [
                "id" => 14,
                "creationTime" => 15_000,
                "createdQuantity" => 0.1,
                "createdResourceId" => 31,
            ],
        ]);
    }
}

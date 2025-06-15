<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredient')->insert([
            [
                "recipeId" => 1,
                "resourceId" => 3,
                "quantity" => 2.0
            ],
            [
                "recipeId" => 2,
                "resourceId" => 14,
                "quantity" => 0.4
            ],
            [
                "recipeId" => 2,
                "resourceId" => 7,
                "quantity" => 0.1
            ],
            [
                "recipeId" => 3,
                "resourceId" => 8,
                "quantity" => 0.8
            ],
            [
                "recipeId" => 3,
                "resourceId" => 7,
                "quantity" => 0.3
            ],
            [
                "recipeId" => 4,
                "resourceId" => 14,
                "quantity" => 0.2
            ],
            [
                "recipeId" => 4,
                "resourceId" => 6,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 4,
                "resourceId" => 10,
                "quantity" => 0.3
            ],
            [
                "recipeId" => 5,
                "resourceId" => 2,
                "quantity" => 0.8
            ],
            [
                "recipeId" => 5,
                "resourceId" => 1,
                "quantity" => 0.4
            ],
            [
                "recipeId" => 5,
                "resourceId" => 8,
                "quantity" => 0.4
            ],
            [
                "recipeId" => 6,
                "resourceId" => 1,
                "quantity" => 1
            ],
            [
                "recipeId" => 6,
                "resourceId" => 4,
                "quantity" => 1
            ],
            [
                "recipeId" => 7,
                "resourceId" => 20,
                "quantity" => 1
            ],
            [
                "recipeId" => 7,
                "resourceId" => 10,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 8,
                "resourceId" => 6,
                "quantity" => 1
            ],
            [
                "recipeId" => 8,
                "resourceId" => 3,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 8,
                "resourceId" => 4,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 9,
                "resourceId" => 5,
                "quantity" => 1
            ],
            [
                "recipeId" => 9,
                "resourceId" => 21,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 10,
                "resourceId" => 12,
                "quantity" => 1
            ],
            [
                "recipeId" => 10,
                "resourceId" => 18,
                "quantity" => 1
            ],
            [
                "recipeId" => 11,
                "resourceId" => 13,
                "quantity" => 1
            ],
            [
                "recipeId" => 11,
                "resourceId" => 10,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 11,
                "resourceId" => 21,
                "quantity" => 1
            ],
            [
                "recipeId" => 12,
                "resourceId" => 25,
                "quantity" => 0.8
            ],
            [
                "recipeId" => 12,
                "resourceId" => 16,
                "quantity" => 0.8
            ],
            [
                "recipeId" => 13,
                "resourceId" => 25,
                "quantity" => 1
            ],
            [
                "recipeId" => 13,
                "resourceId" => 20,
                "quantity" => 0.5
            ],
            [
                "recipeId" => 13,
                "resourceId" => 29,
                "quantity" => 0.1
            ],
            [
                "recipeId" => 14,
                "resourceId" => 17,
                "quantity" => 0.1
            ],
        ]);
    }
}

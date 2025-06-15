<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resource', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary();
            $table->string("name", length: 50);
            $table->float("marketPrice")->comment("Price for 0.1kg");
            $table->integer("timeToMine", unsigned: true)->nullable()->comment("in minutes | null = not mineable");
            $table->float("mineQuantity")->nullable()->comment("in kg | null = not mineable");
            $table->unsignedTinyInteger("levelToMine")->nullable();
            $table->foreign("levelToMine")->references("level")->on("minelevel")->nullOnDelete()->cascadeOnUpdate();
        });

        Schema::create('userresource', function (Blueprint $table) {
            $table->unsignedBigInteger("userId");
            $table->unsignedBigInteger("resourceId");
            $table->float("quantity")->comment("in kg");
            $table->primary(["userId", "resourceId"]);

            // A player cannot own more than 35kg of resources, all resources combined. But this will be checked in PHP
            $table->foreign("userId")->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate();
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();
        });

        Schema::create('recipe', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary();
            $table->unsignedInteger("creationTime")->comment("in minute");
            $table->float("createdQuantity")->comment("in kg");
            $table->unsignedBigInteger("createdResourceId");
            $table->foreign("createdResourceId")->references("id")->on("resource")->restrictOnDelete()->cascadeOnUpdate();
        });

        Schema::create('ingredient', function (Blueprint $table) {
            $table->unsignedBigInteger("resourceId");
            $table->unsignedBigInteger("recipeId");
            $table->primary(["resourceId", "recipeId"]);

            $table->float("quantity")->comment("in kg");

            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign("recipeId")->references("id")->on("recipe")->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient');
        Schema::dropIfExists('recipe');
        Schema::dropIfExists('userresource');
        Schema::dropIfExists('resource');
    }
};

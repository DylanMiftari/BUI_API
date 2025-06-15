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
        Schema::create('housetype', function (Blueprint $table) {
            $table->unsignedMediumInteger("id")->primary();
            $table->string("typeName", 50)->unique();
            $table->unsignedInteger("constructionDuration")->comment("in days");
            $table->float("constructionCost")->comment("money");
            $table->float("maintenanceCost")->comment("weekly");
        });

        Schema::create('housetyperesourcecost', function (Blueprint $table) {
            $table->unsignedMediumInteger("houseTypeId");
            $table->foreign("houseTypeId")->references("id")->on("housetype")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();

            $table->primary(["houseTypeId", "resourceId"]);

            $table->float("quantity")->comment("in kg");
        });

        Schema::create('house', function (Blueprint $table) {
            $table->id();

            $table->unsignedMediumInteger("houseTypeId");
            $table->foreign("houseTypeId")->references("id")->on("housetype")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedInteger("cityId")->nullable();
            $table->foreign("cityId")->references("id")->on("city")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('home', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("houseId");
            $table->foreign("houseId")->references("id")->on("house")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable();
            $table->foreign("userId")->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("renterId")->nullable();
            $table->foreign("renterId")->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate();
            $table->float("rent")->nullable()->comment("weekly");

            $table->float("moneyInSafe")->default(0);
            $table->timestamps();
        });

        Schema::create('homeresourcesafe', function (Blueprint $table) {
            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger("homeId");
            $table->foreign("homeId")->references("id")->on("home")->restrictOnDelete()->restrictOnUpdate();

            $table->primary(["resourceId", "homeId"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homeresourcesafe');
        Schema::dropIfExists('home');
        Schema::dropIfExists('house');
        Schema::dropIfExists('housetyperesourcecost');
        Schema::dropIfExists('housetype');
    }
};

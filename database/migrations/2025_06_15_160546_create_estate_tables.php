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
        Schema::create('estateagencylevel', function (Blueprint $table) {
            $table->unsignedSmallInteger("level")->primary();
            $table->unsignedInteger("maxNbLocation");
        });

        Schema::create('estatecanconstruct', function (Blueprint $table) {
            $table->unsignedSmallInteger("estateAgencyLevel");
            $table->foreign("estateAgencyLevel")->references("level")->on("estateagencylevel")->restrictOnDelete()->restrictOnUpdate();
            $table->unsignedMediumInteger("houseTypeId");
            $table->foreign("houseTypeId")->references("id")->on("housetype")->restrictOnDelete()->restrictOnUpdate();
            $table->primary(["estateAgencyLevel", "houseTypeId"]);
        });

        Schema::create('estateagency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("companyId");
            $table->foreign("companyId")->references("id")->on("company")->cascadeOnDelete()->restrictOnUpdate();
            $table->unsignedSmallInteger("level")->default("1");
            $table->foreign("level")->references("level")->on("estateagencylevel")->restrictOnDelete()->restrictOnUpdate();
            $table->timestamps();
        });

        Schema::create('estaterentaloffer', function (Blueprint $table) {
            $table->id();

            $table->float("rent");
            $table->float("secondRent")->nullable();

            $table->unsignedBigInteger("estateAgencyId");
            $table->foreign("estateAgencyId")->references("id")->on("estateagency")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable();
            $table->foreign("userId")->references("id")->on("users")->nullOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("houseId");
            $table->foreign("houseId")->references("id")->on("house")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentaloffer');
        Schema::dropIfExists('estateagency');
        Schema::dropIfExists('estatecanconstruct');
        Schema::dropIfExists('estateagencylevel');
    }
};

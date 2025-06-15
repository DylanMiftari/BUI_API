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
        Schema::create('companylevel', function (Blueprint $table) {
            $table->unsignedTinyInteger("level")->primary();
            $table->unsignedInteger("priceForNextLevel")->nullable();
        });
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string("name", length: 100);
            $table->float("moneyInSafe")->default(0);
            $table->string("companyType", 50);
            $table->unsignedTinyInteger("companyLevel")->default("1");
            $table->foreign("companyLevel")->references("level")->on("companylevel")->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate();
            $table->integer("cityId", unsigned: true)->default(1);
            $table->foreign("cityId")->references("id")->on("city")->restrictOnDelete()->cascadeOnUpdate();
            $table->boolean("activated")->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
        Schema::dropIfExists('companylevel');
    }
};

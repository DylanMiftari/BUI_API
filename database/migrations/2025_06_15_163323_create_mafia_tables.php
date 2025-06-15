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
        Schema::create('mafialevel', function (Blueprint $table) {
            $table->unsignedSmallInteger("level")->primary();
            $table->float("playerRobPrice");
            $table->float("companyRobPrice");
            $table->float("bankAccountRobPrice");
            $table->float("homeSafeRobPrice");
        });

        Schema::create('mafia', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger("level")->default(1);
            $table->foreign("level")->references("level")->on("mafialevel")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("companyId");
            $table->foreign("companyId")->references("id")->on("company")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('mafiacontract', function (Blueprint $table) {
            $table->id();

            $table->float("clientPrice");
            $table->float("secondPrice")->nullable()->default(null);

            $table->dateTime("robDate")->nullable()->default(null);
            $table->string("robState", 10);
            $table->string("robType", 25);


            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("id")->on("users")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("mafiaId");
            $table->foreign("mafiaId")->references("id")->on("mafia")->cascadeOnDelete()->restrictOnUpdate();

            $table->enum("targetType", [
                "user", "company", "bankAccount", 
                "home", "cyberAttack", "userDrone", "homeDrone",
                "shopLifting", "phishing"
            ]);
            $table->unsignedBigInteger("targetId");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mafiacontract');
        Schema::dropIfExists('mafia');
        Schema::dropIfExists('mafialevel');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mafiacontract', function (Blueprint $table) {
            $table->enum("targetType", [
                "user", "company", "bankAccount",
                "home", "cyberAttack", "userDrone", "homeDrone",
                "shopLifting", "phishing"
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mafiacontract', function (Blueprint $table) {
            $table->enum("targetType", [
                "user", "company", "bankAccount",
                "home", "cyberattack", "userDrone", "homeDrone",
                "shoplifting", "phishing"
            ])->change();
        });
    }
};

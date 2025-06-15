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
        Schema::create('city', function (Blueprint $table) {
            $table->integer("id", unsigned: true)->primary();
            $table->string("name", length: 50);
            $table->string("country", length: 50);
            $table->tinyInteger("maxLevelOfCorp", unsigned: true);
            $table->integer("weeklyTaxes", unsigned: true);
            $table->integer("weeklyCompanyTaxes", unsigned: true);
            $table->tinyInteger("rank", unsigned: true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city');
    }
};

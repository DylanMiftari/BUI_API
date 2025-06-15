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
        Schema::create('minelevel', function (Blueprint $table) {
            $table->unsignedTinyInteger("level")->primary();
            $table->unsignedInteger("priceForNextLevel")->nullable();
        });

        Schema::create('mine', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger("level")->default(1);
            $table->foreign("level")->references("level")->on("minelevel")->restrictOnDelete()->restrictOnUpdate();
            $table->timestamp("startedAt")->nullable();
            $table->unsignedBigInteger("currentTargetResourceId")->nullable();
            $table->foreign("currentTargetResourceId")->references("id")->on("resource")->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mine');
        Schema::dropIfExists('minelevel');
    }
};

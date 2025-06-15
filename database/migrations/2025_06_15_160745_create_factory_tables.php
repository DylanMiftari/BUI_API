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
        Schema::create('factorylevel', function (Blueprint $table) {
            $table->unsignedSmallInteger("level")->primary();
            $table->unsignedInteger("nbMachine");
            $table->unsignedInteger("nbSellSlot");
            $table->float("quantityPerSlot")->comment("in kg");
            $table->unsignedInteger("warehouseCapacity")->comment("in kg");
            $table->float("distanceSellingMultiplicator")->nullable()->comment("null = can't make distance selling");
        });

        Schema::create('factory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("companyId");
            $table->foreign("companyId")->references("id")->on("company")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedSmallInteger("level")->default(1);
            $table->foreign("level")->references("level")->on("factorylevel")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('factorymachine', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("factoryId");
            $table->foreign("factoryId")->references("id")->on("factory")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("currentRecipeId")->nullable();
            $table->foreign("currentRecipeId")->references("id")->on("recipe")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('factoryresourcestorage', function (Blueprint $table) {
            $table->unsignedBigInteger("factoryId");
            $table->foreign("factoryId")->references("id")->on("factory")->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();
            $table->primary(["factoryId", "resourceId"]);

            $table->float("quantity")->comment("in kg");
        });

        Schema::create('factoryproductionhistory', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("machineId");
            $table->foreign("machineId")->references("id")->on("factorymachine")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("recipeId");
            $table->foreign("recipeId")->references("id")->on("recipe")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('factorysellslot', function (Blueprint $table) {
            $table->id();

            $table->float("sellPrice");
            $table->float("quantity")->comment("in kg");
            $table->string("state", 10);

            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("factoryId");
            $table->foreign("factoryId")->references("id")->on("factory")->cascadeOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('factoryresourcesearch', function (Blueprint $table) {
            $table->id();

            $table->float("price");
            $table->float("secondPrice")->nullable()->default(null);

            $table->float("quantity")->comment("in kg");

            $table->string("state", 10);

            $table->unsignedBigInteger("factoryId");
            $table->foreign("factoryId")->references("id")->on("factory")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable()->default(null);
            $table->foreign("userId")->references("id")->on("users")->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });

        Schema::create('factoryplayersearch', function (Blueprint $table) {
            $table->id();

            $table->float("price");
            $table->float("secondPrice")->nullable()->default(null);
            $table->float("quantity")->comment("in kg");
            $table->string("state", 10);

            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("factoryId");
            $table->foreign("factoryId")->references("id")->on("factory")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable()->default(null);
            $table->foreign("userId")->references("id")->on("users")->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factoryplayersearch');
        Schema::dropIfExists('factoryresourcesearch');
        Schema::dropIfExists('factorysellslot');
        Schema::dropIfExists('factoryproductionhistory');
        Schema::dropIfExists('factoryresourcestorage');
        Schema::dropIfExists('factorymachine');
        Schema::dropIfExists('factory');
        Schema::dropIfExists('factorylevel');
    }
};

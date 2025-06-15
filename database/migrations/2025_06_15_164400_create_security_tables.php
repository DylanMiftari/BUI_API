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
        Schema::create('securitycompanylevel', function (Blueprint $table) {
            $table->unsignedSmallInteger("level")->primary();
            $table->float("resourceSafeCapacity")->comment("in kg");

            $table->float("distance_multiplicator")->nullable()->comment("null = no distance transaction");

            $table->boolean("hasAlarm");
            $table->boolean("hasPepperSpray");
            $table->boolean("hasGasDispenser");
            $table->boolean("hasReinforcedDoor");
            $table->boolean("hasBodyGuard");
            $table->boolean("hasSecurityGuard");
            $table->boolean("hasCyberDefense");
            $table->boolean("hasAntiAISystem");
            $table->boolean("hasContainmentSystem");
        });

        Schema::create('securitycompany', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("companyId");
            $table->foreign("companyId")->references("id")->on("company")->cascadeOnDelete()->restrictOnUpdate();
            $table->unsignedSmallInteger("level")->default("1");
            $table->foreign("level")->references("level")->on("securitycompanylevel")->restrictOnDelete()->restrictOnUpdate();
            $table->timestamps();
        });

        Schema::create('securitycompanysafe', function (Blueprint $table) {
            $table->unsignedBigInteger("securityCompanyId");
            $table->foreign("securityCompanyId")->references("id")->on("securitycompany")->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger("resourceId");
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();

            $table->primary(["resourceId", "securityCompanyId"]);

            $table->float("quantity")->comment("in kg");
        });

        Schema::create('securitycompanyprotectionrequest', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("securityCompanyId");
            $table->foreign("securityCompanyId")->references("id")->on("securityCompany")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("id")->on("users")->cascadeOnDelete()->restrictOnUpdate();

            $table->string("protectionType", 50);

            $table->float("price");
            $table->float("secondPrice")->nullable();

            $table->timestamps();
        });

        Schema::create('securitysystem', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("securityCompanyId");
            $table->foreign("securityCompanyId")->references("id")->on("securityCompany")->cascadeOnDelete()->restrictOnUpdate();

            $table->enum("type", [
                "houseAlarm", "companyAlarm", "pepperSpray",
                "bankGasDispenser", "companyGasDispenser",
                "reinforcedDoor", "homeGuard", "bodyGuard",
                "bankSecurityGuard", "companySecurityGuard",
                "cyberDefense", "userAntiAISystem", "homeAntiAISystem",
                "companyContainmentSystem", "bankContainmentSystem"
            ]);
            $table->unsignedBigInteger("protectedId");

            $table->boolean("used")->nullable()
            ->comment("For : pepperSpray, bankGasDispenser, companyGasDispenser, 
            reinforcedDoor, userAntiAISystem, homeAntiAISystem, companyContainmentSystem, 
            bankContainmentSystem");
            $table->boolean("usedContainment")->default(false)
            ->comment("For : companyContainmentSystem and bankContainmentSystem");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('securitysystem');
        Schema::dropIfExists('securitycompanyprotectionrequest');
        Schema::dropIfExists('securitycompanysafe');
        Schema::dropIfExists('securitycompany');
        Schema::dropIfExists('securitycompanylevel');
    }
};

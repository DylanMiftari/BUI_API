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
        Schema::create('banklevel', function (Blueprint $table) {
            $table->unsignedBigInteger("level")->primary();
            $table->unsignedBigInteger("maxMoneyAccount");
            $table->float("maxResourceAccount");
            $table->unsignedInteger("maxNbAccount");
        });

        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("level")->default(1);
            $table->foreign("level")->references("level")->on("banklevel")->restrictOnDelete()->restrictOnUpdate();
            $table->unsignedInteger("accountMaintenanceCost")->default(1000)->comment("Cost for 1 week");
            $table->float("transferCost")->default(0.02)->comment("in percentage");
            $table->unsignedBigInteger("maxAccountMoney")->default(50_000);
            $table->float("maxAccountResource")->default(10.0)->comment("in kg");
            $table->unsignedBigInteger("idCompany");
            $table->foreign("idCompany")->references("id")->on("company")->restrictOnDelete()->restrictOnUpdate();
            $table->timestamps();
        });

        Schema::create('bankaccount', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("accountMaintenanceCost")->comment("Cost for 1 week");
            $table->float("transferCost")->comment("in percentage");
            $table->float("money")->default(0);
            $table->unsignedBigInteger("maxMoney");
            $table->float("maxResource");

            $table->unsignedBigInteger("bankId");
            $table->foreign("bankId")->references("id")->on("bank")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate();

            $table->boolean("isEnable")->default(true);

            $table->timestamps();
        });

        Schema::create('creditrequest', function (Blueprint $table) {
            $table->id();
            $table->string("status", 25);
            $table->float("money");
            $table->float("weeklypayment");
            $table->float("alreadyPayed")->default(0);
            $table->float("rate")->nullable();
            $table->text("description");

            $table->unsignedBigInteger("userId");
            $table->foreign("userId")->references('id')->on("users")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("bankId");
            $table->foreign("bankId")->references("id")->on("bank")->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });

        Schema::create('bankresourceaccount', function (Blueprint $table) {
            $table->unsignedBigInteger("bankAccountId");
            $table->unsignedBigInteger("resourceId");
            $table->primary(["bankAccountId", "resourceId"]);

            $table->float("quantity")->comment("in kg");

            $table->foreign("bankAccountId")->references("id")->on("bankaccount")->restrictOnDelete()->restrictOnUpdate();
            $table->foreign("resourceId")->references("id")->on("resource")->restrictOnDelete()->restrictOnUpdate();
        });

        Schema::create('bankaccounttransaction', function (Blueprint $table) {
            $table->id();
            $table->float("money");
            $table->string("description", 150)->default("");

            $table->unsignedBigInteger("bankAccountId");
            $table->foreign("bankAccountId")->references("id")->on("bankaccount")->cascadeOnDelete()->cascadeOnUpdate();

            $table->float("transfert_cost");

            $table->boolean("isCredit")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankaccounttransaction');
        Schema::dropIfExists('bankresourceaccount');
        Schema::dropIfExists('creditrequest');
        Schema::dropIfExists('bankaccount');
        Schema::dropIfExists('bank');
        Schema::dropIfExists('banklevel');
    }
};

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
            $table->dropColumn("robType");
            $table->string("robState", 25)->change();
            $table->boolean("robSuccess")->nullable()->default(null);
            $table->integer("robWinnings")->nullable()->default(null);
            $table->integer("robCost")->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mafiacontract', function (Blueprint $table) {
            $table->string("robType", 25);
            $table->dropColumn("robSuccess");
            $table->dropColumn("robWinnings");
            $table->dropColumn("robCost");
        });
    }
};

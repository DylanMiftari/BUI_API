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
        Schema::create('casinolevel', function (Blueprint $table) {
            $table->unsignedSmallInteger("level")->primary();
            $table->unsignedInteger("nbMaxTicket")->nullable()->comment("null = no limit");
            $table->unsignedInteger("nbMaxVIPTicket")->nullable()->comment('null = no limiy');
            $table->unsignedInteger("maxTicketPrice")->nullable()->comment("null = not buyable");
            $table->unsignedInteger("maxVIPTicketPrice")->nullable()->comment("null = not buyable");
            $table->unsignedInteger("maxSuiteRent")->nullable()->comment("weekly | null = not rentable");
            $table->unsignedInteger("nbMaxSuite")->nullable();

            // Roulette (level 1+)
            $table->unsignedBigInteger("rouletteMaxBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("rouletteMaxVIPBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("rouletteMaxUltraVIPBet")->nullable()->comment("null = casino not have this game");

            // Dice (level 2+)
            $table->unsignedBigInteger("diceMaxBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("diceMaxVIPBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("diceMaxUltraVIPBet")->nullable()->comment("null = casino not have this game");

            // Poker (level 3+)
            $table->unsignedBigInteger("pokerMaxBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("pokerMaxVIPBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("pokerMaxUltraVIPBet")->nullable()->comment("null = casino not have this game");

            // Black Jack (level 4+)
            $table->unsignedBigInteger("blackJackMaxBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("blackJackMaxVIPBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("blackJackMaxUltraVIPBet")->nullable()->comment("null = casino not have this game");

            // Roulette 2 (level 5+)
            $table->unsignedBigInteger("roulette2MaxBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("roulette2MaxVIPBet")->nullable()->comment("null = casino not have this game");
            $table->unsignedBigInteger("roulette2MaxUltraVIPBet")->nullable()->comment("null = casino not have this game");
        });

        Schema::create('casino', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("ticketPrice")->default(75);
            $table->unsignedInteger("VIPTicketPrice")->default(7500);

            $table->unsignedSmallInteger("level")->default(1);
            $table->foreign("level")->references("level")->on("casinolevel")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("companyId");
            $table->foreign("companyId")->references("id")->on("company")->restrictOnDelete()->restrictOnUpdate();

            // Roulette (level 1+)
            $table->float("rouletteSequenceMultiplicator")->default(3.5);
            $table->float("rouletteTripletMultiplcator")->default(10);
            $table->float("rouletteTripleSeventMultiplicator")->default(25);
            $table->unsignedBigInteger("rouletteMaxBet")->default(500);

            $table->float("rouletteVIPSequenceMultiplicator")->default(5);
            $table->float("rouletteVIPTripletMultiplcator")->default(15);
            $table->float("rouletteVIPTripleSeventMultiplicator")->default(35);
            $table->unsignedBigInteger("rouletteMaxVIPBet")->default(4000);

            $table->float("rouletteUltraVIPSequenceMultiplicator")->default(10);
            $table->float("rouletteUltraVIPTripletMultiplcator")->default(30);
            $table->float("rouletteUltraVIPTripleSeventMultiplicator")->default(50);
            $table->unsignedBigInteger("rouletteMaxUltraVIPBet")->default(25_000);
            $table->unsignedInteger("rouletteNbFreeParty")->default(5)->comment("weekly");

            // Dice (level 2+)
            $table->unsignedTinyInteger("diceGoal")->default(7);
            $table->float("diceWinMultiplicator")->default(4);
            $table->unsignedBigInteger("diceMaxBet")->default(750);

            $table->unsignedTinyInteger("diceVIPGoal")->default(7);
            $table->float("diceVIPWinMultiplicator")->default(5);
            $table->unsignedBigInteger("diceVIPMaxBet")->default(5_000);

            $table->unsignedTinyInteger("diceUltraVIPGoal")->default(12);
            $table->float("diceUltraVIPWinMultiplicator")->default(30);
            $table->unsignedBigInteger("diceUltraVIPMaxBet")->default(45_000);
            $table->unsignedInteger("diceNbFreeParty")->default(10)->comment("weekly");

            // Poker (level 3+)
            $table->float("nothingMultiplicator")->default(0);
            $table->float("onePairMultiplicator")->default(0);
            $table->float("twoPairMultiplicator")->default(3);
            $table->float("threeOfAKindMultiplicator")->default(10);
            $table->float("straightMultiplicator")->default(30);
            $table->float("flushMultiplicator")->default(85);
            $table->float("fullHouseMultiplicator")->default(150);
            $table->float("fourOfAKindMultiplicator")->default(250);
            $table->float("straightFlushMultiplicator")->default(500);
            $table->float("royalFlushMultiplicator")->default(1_000);
            $table->unsignedBigInteger("pokerMaxBet")->default(5_000);

            $table->float("nothingVIPMultiplicator")->default(0);
            $table->float("onePairVIPMultiplicator")->default(0.5);
            $table->float("twoPairVIPMultiplicator")->default(7);
            $table->float("threeOfAKindVIPMultiplicator")->default(20);
            $table->float("straightVIPMultiplicator")->default(75);
            $table->float("flushVIPMultiplicator")->default(200);
            $table->float("fullHouseVIPMultiplicator")->default(350);
            $table->float("fourOfAKindVIPMultiplicator")->default(875);
            $table->float("straightFlushVIPMultiplicator")->default(2000);
            $table->float("royalFlushVIPMultiplicator")->default(10_000);
            $table->unsignedBigInteger("pokerMaxVIPBet")->default(25_000);

            $table->float("nothingUltraVIPMultiplicator")->default(0);
            $table->float("onePairUltraVIPMultiplicator")->default(0.8);
            $table->float("twoPairUltraVIPMultiplicator")->default(10);
            $table->float("threeOfAKindUltraVIPMultiplicator")->default(30);
            $table->float("straightUltraVIPMultiplicator")->default(100);
            $table->float("flushUltraVIPMultiplicator")->default(350);
            $table->float("fullHouseUltraVIPMultiplicator")->default(500);
            $table->float("fourOfAKindUltraVIPMultiplicator")->default(1500);
            $table->float("straightFlushUltraVIPMultiplicator")->default(10_000);
            $table->float("royalFlushUltraVIPMultiplicator")->default(100_000);
            $table->unsignedBigInteger("pokerMaxUltraVIPBet")->default(150_000);
            $table->unsignedInteger("pokerNbFreeParty")->default(5);

            // Black Jack (level 4+)
            $table->float("blackJackWinMultiplicator")->default(1.5);
            $table->float("blackJackMultiplicator")->default(3);
            $table->unsignedBigInteger("blackJackMaxBet")->default(10_000);

            $table->float("blackJackVIPWinMultiplicator")->default(1.5);
            $table->float("blackJackVIPMultiplicator")->default(5);
            $table->unsignedBigInteger("blackJackVIPMaxBet")->default(60_000);

            $table->float("blackJackUltraVIPWinMultiplicator")->default(1.5);
            $table->float("blackJackUltraVIPMultiplicator")->default(6);
            $table->unsignedBigInteger("blackJackUltraVIPMaxBet")->default(150_000);
            $table->unsignedInteger("blackJackNbFreeParty")->default(5);

            // Roulette 2 (level 5+)
            $table->float("roulette2StraigthUpMultiplicator")->default(35);
            $table->float("roulette2SplitMultiplicator")->default(17);
            $table->float("roulette2treetMultiplicator")->default(11);
            $table->float("roulette2CornerMultiplicator")->default(8);
            $table->float("roulette2SixLineMultiplicator")->default(5);
            $table->float("roulette2ColumnMultiplicator")->default(2);
            $table->float("roulette2DozenMultiplicator")->default(2);
            $table->float("roulette2OddEvenMultiplicator")->default(1.25);
            $table->float("roulette2RedBlackMultiplicator")->default(1.25);
            $table->float("roulette2MiddleMultiplicator")->default(1.25); // For 1-18 or 19-36 bet
            $table->unsignedBigInteger("roulette2MaxBet")->default(40_000);

            $table->float("roulette2VIPStraigthUpMultiplicator")->default(35);
            $table->float("roulette2VIPSplitMultiplicator")->default(17);
            $table->float("roulette2VIPtreetMultiplicator")->default(11);
            $table->float("roulette2VIPCornerMultiplicator")->default(8);
            $table->float("roulette2VIPSixLineMultiplicator")->default(5);
            $table->float("roulette2VIPColumnMultiplicator")->default(2);
            $table->float("roulette2VIPDozenMultiplicator")->default(2);
            $table->float("roulette2VIPOddEvenMultiplicator")->default(1.25);
            $table->float("roulette2VIPRedBlackMultiplicator")->default(1.25);
            $table->float("roulette2VIPMiddleMultiplicator")->default(1.25); // For 1-18 or 19-36 bet
            $table->unsignedBigInteger("roulette2VIPMaxBet")->default(140_000);

            $table->float("roulette2UltraVIPStraigthUpMultiplicator")->default(35);
            $table->float("roulette2UltraVIPSplitMultiplicator")->default(17);
            $table->float("roulette2UltraVIPtreetMultiplicator")->default(11);
            $table->float("roulette2UltraVIPCornerMultiplicator")->default(8);
            $table->float("roulette2UltraVIPSixLineMultiplicator")->default(5);
            $table->float("roulette2UltraVIPColumnMultiplicator")->default(2);
            $table->float("roulette2UltraVIPDozenMultiplicator")->default(2);
            $table->float("roulette2UltraVIPOddEvenMultiplicator")->default(1.5);
            $table->float("roulette2UltraVIPRedBlackMultiplicator")->default(1.5);
            $table->float("roulette2UltraVIPMiddleMultiplicator")->default(1.5); // For 1-18 or 19-36 bet
            $table->unsignedBigInteger("roulette2UltraVIPMaxBet")->default(500_000);
            $table->unsignedInteger("roulette2NbFreeParty")->default(5);

            $table->timestamps();
        });

        Schema::create('casinoticket', function (Blueprint $table) {
            $table->id();

            $table->boolean("isVIP");

            $table->unsignedBigInteger("casinoId");
            $table->foreign("casinoId")->references("id")->on("casino")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable();
            $table->foreign("userId")->references("id")->on("users")->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });

        Schema::create('casinoparty', function (Blueprint $table) {
            $table->id();
            $table->string("gameName", 25);
            $table->unsignedBigInteger("bet");
            $table->unsignedBigInteger("winnings");

            $table->unsignedBigInteger("casinoId");
            $table->foreign("casinoId")->references("id")->on("casino")->cascadeOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable();
            $table->foreign("userId")->references("id")->on("users")->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });

        Schema::create('casinosuite', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("rent")->comment("weekly");

            $table->unsignedBigInteger("casinoId");
            $table->foreign("casinoId")->references("id")->on("casino")->restrictOnDelete()->restrictOnUpdate();

            $table->unsignedBigInteger("userId")->nullable();
            $table->foreign("userId")->references("id")->on("users")->nullOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casinosuite');
        Schema::dropIfExists('casinoparty');
        Schema::dropIfExists('casinoticket');
        Schema::dropIfExists('casino');
        Schema::dropIfExists('casinolevel');
    }
};

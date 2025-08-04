<?php 

namespace App\Http\Actions\Mine;

use App\Helpers\Money;
use App\Models\Mine;
use Illuminate\Support\Facades\Auth;

class BuyNewMineAction {

    public function handle(): Mine {
        $user = Auth::user();
        $mineCount = $user->mines->count();

        Money::pay(config("mine.price_for_new_mine")[$mineCount+1]);

        $mine = new Mine();
        $mine->userId = $user->id;
        $mine->level = 1;
        $mine->save();

        return $mine;
    }

}
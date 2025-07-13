<?php 

namespace App\Http\Actions\Mine;

use App\Helpers\Money;
use App\Models\Mine;

class UpgradeMineAction {

    public function handle(Mine $mine) {
        $mineLevel = $mine->mineLevel;
        Money::pay($mineLevel->priceForNextLevel);
        $mine->upgrade();
    }

}
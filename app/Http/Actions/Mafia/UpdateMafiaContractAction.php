<?php

namespace App\Http\Actions\Mafia;

use App\Enums\MafiaContractStatus;
use App\Models\MafiaContract;

class UpdateMafiaContractAction
{

    public function handle(MafiaContract $contract, int|null $price, MafiaContractStatus|null $status): MafiaContract {
        if($price) {
            $contract->clientPrice = $price;
        }
        if($status) {
            $contract->robState = $status;
        }
        $contract->save();

        return $contract;
    }

}

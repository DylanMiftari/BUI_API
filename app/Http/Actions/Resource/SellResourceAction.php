<?php

namespace App\Http\Actions\Resource;

use App\Helpers\Money;
use App\Helpers\Resource as HelpersResource;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;

class SellResourceAction {

    public function handle(array $sellData) {
        $resourceIds = array_map(fn($r) => $r["resource_id"], $sellData);
        $resourceToSell = Resource::whereIn("id", $resourceIds)->get();
        $userResources = Auth::user()->userResources;

        $selledResources = [];
        $money = 0;

        foreach($sellData as $data) {
            $currentUserResource = $userResources->where("resourceId", $data["resource_id"])->first();
            $currentResource = $resourceToSell->where("id", $data["resource_id"])->first();
            if($currentUserResource === null) {
                $selledResources[] = [
                    "id" => $currentResource->id,
                    "name" => $currentResource->name,
                    "quantity" => 0
                ];
            } else {
                $quantityToSell = min($data["quantity"], $currentUserResource->quantity);
                $selledResources[] = [
                    "id" => $currentResource->id,
                    "name" => $currentResource->name,
                    "quantity" => $quantityToSell
                ];
                $money = round($money + round($quantityToSell * $currentResource->marketPrice / 0.1, 2), 2);
                HelpersResource::remove($currentResource, $quantityToSell);
            }
        }
        Money::creditMoney($money, "You sell resources");

        return [
            "selled_resources" => $selledResources,
            "money" => $money
        ];
    }

}

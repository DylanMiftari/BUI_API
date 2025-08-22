<?php

namespace App\Services;

use App\Models\Resource;

class ResourceService {

    public function getSellValue(array $sellData) {
        $resourceIds = array_map(fn($r) => $r["resource_id"], $sellData);
        $resourceToSell = Resource::whereIn("id", $resourceIds)->get();

        $totalValue = 0;
        foreach($sellData as $data) {
            $resource = $resourceToSell->where("id", $data["resource_id"])->first();
            $value = round($data["quantity"] * $resource->marketPrice / 0.1, 2);

            $totalValue = round($totalValue + $value, 2);
        }

        return $totalValue;
    }

}
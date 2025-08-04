<?php 

namespace App\Http\Actions\Mine;

use App\Helpers\Resource;
use App\Models\Mine;

class CollectMineAction {

    public function handle(Mine $mine) {
        Resource::add($mine->resource, $mine->resource->mineQuantity);
        $mine->currentTargetResourceId = null;
        $mine->save();

        return $mine;
    }

}
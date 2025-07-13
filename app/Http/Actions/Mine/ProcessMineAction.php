<?php 

namespace App\Http\Actions\Mine;

use App\Models\Mine;
use App\Models\Resource;
use Illuminate\Support\Carbon;

class ProcessMineAction {

    public function handle(Mine $mine, Resource $resource): Mine {
        $mine->currentTargetResourceId = $resource->id;
        $mine->startedAt = Carbon::now();
        $mine->save();

        return $mine;
    }

}
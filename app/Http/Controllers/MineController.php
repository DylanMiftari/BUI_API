<?php

namespace App\Http\Controllers;

use App\Helpers\Resource as HelpersResource;
use App\Helpers\With;
use App\Http\Actions\Mine\BuyNewMineAction;
use App\Http\Actions\Mine\CollectMineAction;
use App\Http\Actions\Mine\ProcessMineAction;
use App\Http\Actions\Mine\UpgradeMineAction;
use App\Http\Requests\Mine\MineProcessRequest;
use App\Http\Resources\MineResource;
use App\Models\Mine;
use App\Models\Resource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MineController extends Controller
{
    use AuthorizesRequests;

    public function index() {
        With::add("resource");
        return MineResource::collection(Auth::user()->mines);
    }

    public function show(Mine $mine) {
        With::add("resource");
        return new MineResource($mine);
    }

    public function upgrade(Mine $mine, UpgradeMineAction $action) {
        $this->authorize("upgrade", $mine);

        $action->handle($mine);
        return response()->json([
            "result" => true
        ]);
    }

    public function process(MineProcessRequest $request, Mine $mine, ProcessMineAction $action) {
        $resource = Resource::findOrFail($request->input("resource_id"));

        $updatedMine = $action->handle($mine, $resource);

        With::add("resource");
        return new MineResource($updatedMine);
    }

    public function collect(Mine $mine, CollectMineAction $action) {
        $this->authorize("collect", $mine);

        $action->handle($mine);

        return response()->json([
            "result" => true
        ]);
    }

    public function buyNewMine(BuyNewMineAction $action) {
        $this->authorize("buy", Mine::class);

        $mine = $action->handle();

        return new MineResource($mine);
    }
}

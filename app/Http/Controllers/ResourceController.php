<?php

namespace App\Http\Controllers;

use App\Helpers\Money;
use App\Http\Actions\Resource\SellResourceAction;
use App\Http\Requests\Resource\ResourceIndexRequest;
use App\Http\Requests\Resource\SellResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Services\ResourceService;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    public function __construct(private ResourceService $resourceService) {
    }

    public function index(ResourceIndexRequest $request) {
        $query = Resource::query();
        if($request->has("mineable_at")) {
            $query->where("levelToMine", "<=", $request->input("mineable_at"));
        }

        return ResourceResource::collection($query->get());
    }

    /**
     * We will only sell the resources that the user has. For example, if the user wants to sell 
     * 2 kg of stones but only has 1 kg, we will sell 1 kg of stones and not 2 kg.
     */
    public function sell(SellResourceRequest $request, SellResourceAction $action) {
        $sellData = $request->input("resources");
        $totalSellValue = $this->resourceService->getSellValue($sellData);
        Money::canStore($totalSellValue);

        $result = $action->handle($sellData);

        return $result;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resource\ResourceIndexRequest;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(ResourceIndexRequest $request) {
        $query = Resource::query();
        if($request->has("mineable_at")) {
            $query->where("levelToMine", "<=", $request->input("mineable_at"));
        }

        return ResourceResource::collection($query->get());
    }
}

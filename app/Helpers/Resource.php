<?php 

namespace App\Helpers;

use App\Models\Resource as ModelsResource;
use App\Models\UserResource;
use Illuminate\Support\Facades\Auth;

class Resource {

    public static function canStore(float $quantity) {
        $user = Auth::user();
        $maxResourceStorage = config("user.max_player_resource");

        return $user->resourceQuantity() + $quantity <= $maxResourceStorage;
    }

    public static function add(ModelsResource $resource, float $quantity) {
        $user = Auth::user();
        if($user->resources()->where("id", $resource->id)->exists()) {
            $userResource = $user->userResources()->where("resourceId", $resource->id)->first();
            $userResource->quantity = round($userResource->quantity + $quantity, 2);
            $userResource->save();
        } else {
            $userResource = new UserResource();
            $userResource->userId = $user->id;
            $userResource->resourceId = $resource->id;
            $userResource->quantity = $quantity;
            $userResource->save();
        }
    }

}
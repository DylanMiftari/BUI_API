<?php

namespace App\Http\Controllers;

use App\Helpers\With;
use App\Http\Resources\MineResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MineController extends Controller
{
    public function index() {
        With::add("resource");
        return MineResource::collection(Auth::user()->mines);
    }
}

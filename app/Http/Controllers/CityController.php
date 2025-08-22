<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function myCity() {
        return new CityResource(Auth::user()->city);
    }
}

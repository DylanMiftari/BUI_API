<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        return HomeResource::collection(Auth::user()->homesInTheCity());
    }
}

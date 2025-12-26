<?php

namespace App\Http\Controllers;

use App\Http\Resources\MafiaResource;
use App\Models\Mafia;
use Illuminate\Http\Request;

class MafiaController extends Controller
{
    //
    public function getMafiaForClient(Mafia $mafia)
    {
        return new MafiaResource($mafia);
    }
}

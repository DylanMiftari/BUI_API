<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankAccountResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    //
    public function getBankAccounts()
    {
        return BankAccountResource::collection(Auth::user()->bankAccounts);
    }
}

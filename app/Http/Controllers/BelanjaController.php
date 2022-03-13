<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BelanjaController extends Controller
{
    public function beli()
    {
        if (Auth::user()) {
            return redirect()->route('login');
        }
    }
}

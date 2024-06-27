<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClockController extends Controller
{
    public function showClock()
    {
        return view('clock');
    }
}

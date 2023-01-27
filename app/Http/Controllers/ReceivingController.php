<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    public function show()
    {
        return view('user.receiving');
    }
}

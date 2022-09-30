<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarCraftController extends Controller
{
    public function home()
    {
        return view('warcraft.home');
    }
}

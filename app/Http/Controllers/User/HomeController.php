<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

class HomeController extends UserController
{
    public function index()
    {
        return view("{$this->platform}.home");
    }

    public function first()
    {
        return view("{$this->platform}.home");
    }

}

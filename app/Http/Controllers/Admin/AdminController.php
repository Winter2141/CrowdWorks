<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    protected $platform = 'admin';
    protected $per_page = 25;

    public function __construct()
    {
       $this->middleware('auth:admin');
    }
}

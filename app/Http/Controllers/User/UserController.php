<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{

    protected $platform = 'user';
    protected $per_page = 20;

    public function __construct()
    {

    }

}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
          return view('frontend.pages.index');
    }
    //for login 
    public function loginPage()
    {
          return view('frontend.pages.login');
    }
}

<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function welcome()
    {
    	return view('welcome');
    }

    public function android()
    {
    	return view('menu/top_nav/android');
    }

    public function contact()
    {
    	return view('menu/top_nav/contact');
    }
}

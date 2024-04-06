<?php

namespace App\Http\Controllers\pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function showdashboard()
    {
        return view('pages.dashboard');
    }

    public function showhome()
    {
        return view('welcome');
    }

    
    
}

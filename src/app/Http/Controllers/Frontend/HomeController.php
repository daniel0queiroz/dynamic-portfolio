<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $hero = Hero::first();
        return view('frontend.home', compact('hero'));
    }
}

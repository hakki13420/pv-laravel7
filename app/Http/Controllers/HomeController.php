<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $configuration=Configuration::first();
        $slogan=$configuration->slogan;
        $organisme=$configuration->organisme;

        return view('home',['slogan'=>$slogan, 'organisme'=>$organisme]);
    }
}

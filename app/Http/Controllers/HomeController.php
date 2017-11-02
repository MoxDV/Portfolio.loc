<?php

namespace Portfolio\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function logout(){
        if(auth()->check()) auth()->logout();
        return redirect()->route('home');
    }
}

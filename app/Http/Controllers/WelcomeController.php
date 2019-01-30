<?php

namespace App\Http\Controllers;


class WelcomeController extends Controller
{
    public function index()
    {
//        return phpinfo();
        //return "Hello";
        return view('frontEnd.home.home');
    }
}

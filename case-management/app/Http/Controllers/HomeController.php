<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {

        $this->logAction("User viewed home", 'info', 'audit', "index", "Home");
        return view('home');
    }

    public function dashboard()
    {
        $this->logAction("User viewed dashboard", 'info', 'audit', "dashboard", "Home");
        return view('dashboard');
    }
}

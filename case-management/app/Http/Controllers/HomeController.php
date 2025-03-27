<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $this->logAction("User viewed home", "index", "Home");
        return view('home');
    }

    public function dashboard()
    {
        $this->logAction("User viewed dashboard", "dashboard", "Home");
        return view('dashboard');
    }
    public function settings()
    {
        $this->logAction("User viewed settings", "settings", "Home");
        return view('settings');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'dashboard_items' => 'array',
        ]);

        $user = auth()->user();
        $user->dashboard_preferences = $request->input('dashboard_items', []);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Dashboard preferences updated.');
    }
}

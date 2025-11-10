<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AuthComposer
{
  public function compose(View $view)
  {
    $isAuthenticated = Auth::check();
    $user = Auth::user();

    $view->with([
      'isAuthenticated' => $isAuthenticated,
      'currentUser' => $user,
      'dashboardUrl' => $isAuthenticated ? route('dashboard') : route('login'),
      'greeting' => $isAuthenticated ? 'Welcome back!' : 'Please log in.',
    ]);
  }
}

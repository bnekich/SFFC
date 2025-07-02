<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TwoFactorAuthCodeMail;
use App\Models\User;
use App\Notifications\SendTwoFactorCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
  /**
   * Display the 2FA challenge form.
   */
  public function showChallenge(Request $request)
  {
    $user = User::find($request->session()->get('2fa_user_id'));

    // Check if the code has already been sent and is not expired
    $codeSent = $request->session()->has('2fa_code') &&
      now()->lessThan($request->session()->get('2fa_code_sent_at', now()->subMinutes(11))->addMinutes(10));

    return view('auth.2fa-challenge', [
      'hasSms' => !is_null($user->phone),
      'hasEmail' => !is_null($user->email),
      'codeSent' => $codeSent,
    ]);
  }

  /**
   * Send the 2FA code to the user.
   */
  public function sendCode(Request $request)
  {
    $request->validate(['method' => 'required|in:sms,email']);

    $user = User::find($request->session()->get('2fa_user_id'));
    // TODO Uncomment for deploy
    //$code = random_int(100000, 999999);

    // TODO Remove for deploy
    $code = 111111;

    // Store code and timestamp in session
    $request->session()->put('2fa_code', $code);
    $request->session()->put('2fa_code_sent_at', now());

    if ($request->method === 'sms') {
      if (is_null($user->phone)) {
        return back()->with('error', 'No phone number is associated with this account.');
      }
      $user->notify(new SendTwoFactorCode((string)$code));
      $message = 'A verification code has been sent to your phone number.';
    } else { // email
      Mail::to($user->email)->send(new TwoFactorAuthCodeMail((string)$code));
      $message = 'A verification code has been sent to your email address.';
    }

    return redirect()->route('2fa.challenge')->with('success', $message);
  }

  /**
   * Verify the 2FA code and log the user in.
   */
  public function verify(Request $request)
  {
    $request->validate(['code' => 'required|numeric']);

    if (!$request->session()->has('2fa_code')) {
      return redirect()->route('show.login')->with('error', 'Verification process expired. Please log in again.');
    }

    // Check for code expiration (e.g., 10 minutes)
    if (now()->greaterThan($request->session()->get('2fa_code_sent_at')->addMinutes(10))) {
      $request->session()->forget(['2fa_user_id', '2fa_code', '2fa_code_sent_at']);
      return redirect()->route('show.login')->with('error', 'Verification code has expired. Please log in again.');
    }

    if ((int)$request->code !== (int)$request->session()->get('2fa_code')) {
      return back()->withErrors(['code' => 'The provided code is incorrect.']);
    }

    // Code is correct, log the user in
    $user = User::find($request->session()->get('2fa_user_id'));
    Auth::login($user);

    // Clean up session
    $request->session()->forget(['2fa_user_id', '2fa_code', '2fa_code_sent_at']);
    $request->session()->regenerate();

    return redirect()->route('dashboard');
  }
}

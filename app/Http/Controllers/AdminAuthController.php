<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function displayLoginPage ()
    {
        return view ('adminLogin');
    }

    public function login (Request $request)
    {
        $creds = $request->only('login', 'password');
        if (Auth::guard()->attempt($creds, $request->filled('remember')))
        {
            $request->session()->regenerate();
            return redirect()->route('admin_home');
        }
        return $this->sendFailedLoginResponse($request);

        //return redirect()->route('login_admin')->withErrors(['login' => Lang::get('auth.failed')]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('landing');
    }
}

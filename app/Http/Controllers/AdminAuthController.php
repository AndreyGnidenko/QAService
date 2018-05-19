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
        return view ('guest.login');
    }

    public function login (Request $request)
    {
        $creds = $request->only('login', 'password');
        if (Auth::guard()->attempt($creds, $request->filled('remember')))
        {
            return redirect()->route('topics.index');
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('guest');
    }
}

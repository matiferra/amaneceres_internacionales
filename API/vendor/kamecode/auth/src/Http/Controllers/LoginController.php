<?php

namespace App\Http\Controllers\Auth\${namespace};

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        return route('${route}.home');
    }

    public function __construct()
    {
        $this->middleware('guest:${guard}')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.${view}.login');
    }

    protected function guard()
    {
       return \Auth::guard('${guard}');
    }
}

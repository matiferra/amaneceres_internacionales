<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function redirectTo()
    {
        return route("user.home");
    }

    public function __construct()
    {
        $this->middleware("guest:user");
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view("auth.user.reset")->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return \Password::broker('user');
    }

    protected function guard()
    {
        return \Auth::guard('user');
    }
}

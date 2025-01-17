<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function redirectTo()
    {
        return route("admin.home");
    }

    public function __construct()
    {
        $this->middleware("guest:admin");
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view("auth.admin.reset")->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return \Password::broker('admin');
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }
}

<?php

namespace App\Http\Controllers\Auth\Web;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function redirectTo()
    {
        return route("web.home");
    }

    public function __construct()
    {
        $this->middleware("guest:web");
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view("auth.web.reset")->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return \Password::broker('web');
    }

    protected function guard()
    {
        return \Auth::guard('web');
    }
}

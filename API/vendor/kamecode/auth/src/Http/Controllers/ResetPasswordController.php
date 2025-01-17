<?php

namespace App\Http\Controllers\Auth\${namespace};

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function redirectTo()
    {
        return route("${route}.home");
    }

    public function __construct()
    {
        $this->middleware("guest:${guard}");
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view("auth.${view}.reset")->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return \Password::broker('${guard}');
    }

    protected function guard()
    {
        return \Auth::guard('${guard}');
    }
}

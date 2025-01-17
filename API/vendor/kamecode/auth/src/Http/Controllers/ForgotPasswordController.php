<?php

namespace App\Http\Controllers\Auth\${namespace};

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.${view}.email');
    }

    public function broker()
	{
	    return \Password::broker('${guard}');
	}
}

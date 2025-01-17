<?php

namespace App\Http\Controllers\Auth\${namespace};

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected function redirectTo()
    {
        return route("${route}.home");
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('auth.${view}.verify');
    }

    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('${guard}')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('${guard}')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('${guard}')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('${guard}')->markEmailAsVerified()) {
            event(new Verified($request->user('${guard}')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}

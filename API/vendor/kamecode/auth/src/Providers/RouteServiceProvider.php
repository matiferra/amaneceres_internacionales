<?php

namespace KameCode\Auth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $guards = config('auth.guards');

        foreach ($guards as $guard => $guardOptions) {
            if ($guardOptions['driver'] != 'session') continue;

            $namespace = config("kameauth.namespaces.$guard", Str::studly($guard));
            $prefix = config("kameauth.routes.$guard.prefix", $guard);
            $name = config("kameauth.routes.$guard.name", $guard);
            $groups = config("kameauth.routes.$guard.groups", ['authentication', 'registration', 'password-reset']);
            if (!is_array($groups)) $groups = [groups];

            Route::middleware('web')
                ->prefix($prefix)
                ->namespace("App\Http\Controllers\Auth\\$namespace")
                ->name("$name.")
                ->group(function ($router) use ($groups) {
                    // Authentication Routes...
                    if (in_array('authentication', $groups)) {
                        $router->get('login', 'LoginController@showLoginForm')->name('login');
                        $router->post('login', 'LoginController@login')->name('login');
                        $router->get('logout', 'LoginController@logout')->name('logout');
                    }

                    // Registration Routes...
                    if (in_array('registration', $groups)) {
                        $router->get('register', 'RegisterController@showRegistrationForm')->name('register');
                        $router->post('register', 'RegisterController@register')->name('register');
                    }

                    // Password Reset Routes...
                    if (in_array('password-reset', $groups)) {
                        $router->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                        $router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                        $router->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
                        $router->post('password/reset', 'ResetPasswordController@reset')->name('password.update');
                    }

                    // Email Verification
                    if (in_array('email-verification', $groups)) {
                        $router->get('email/verify', 'VerificationController@show')->name('verification.notice');
                        $router->get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
                        $router->post('email/resend', 'VerificationController@resend')->name('verification.resend');
                    }
                })
            ;
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $guard;

    public function handle($request, Closure $next, ...$guards)
    {
    	$this->guard = !$guards ? config('auth.defaults.guard') : $guards[0];

    	$this->authenticate($request, $guards);

    	return $next($request);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $routeName = config('kameauth.routes.' . $this->guard . '.name', $this->guard);
            return route("$routeName.login");
        }
    }
}

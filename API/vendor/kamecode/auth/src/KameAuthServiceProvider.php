<?php

namespace KameCode\Auth;

use Illuminate\Support\ServiceProvider;

class KameAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(Providers\RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/kameauth.php' => config_path('kameauth.php'),
        ]);

        $this->publishes([
            __DIR__.'/Http/Middleware/Authenticate.php' => app_path('Http/Middleware/Authenticate.php'),
        ]);

        $this->commands([Console\Commands\MakeAuth::class]);
    }
}

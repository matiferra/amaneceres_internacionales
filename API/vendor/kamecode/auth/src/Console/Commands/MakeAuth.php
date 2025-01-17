<?php

namespace Kamecode\Auth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeAuth extends Command
{
    protected $signature = 'make:auth';

    protected $description = 'Create views, controllers and notifications for auth';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->createControllers();
        $this->createViews();
        $this->createNotifications();
        $this->createMigrations();

        $this->info('Done!');
    }

    private function createControllers()
    {
        $controllers = [
            'authentication' => ['LoginController.php'],
            'registration' => ['RegisterController.php'],
            'password-reset' => ['ResetPasswordController.php', 'ForgotPasswordController.php'],
            'email-verification' => ['VerificationController.php'],
        ];

        $this->copyFiles($controllers,  __DIR__ . '/../../Http/Controllers', app_path('Http/Controllers/Auth/${namespace}'));
    }

    private function createViews()
    {
        $views = [
            'authentication' => ['login.blade.php'],
            'registration' => ['register.blade.php'],
            'password-reset' => ['email.blade.php', 'reset.blade.php'],
            'email-verification' => ['verify.blade.php'],
        ];

        $this->copyFiles($views,  __DIR__ . '/../../../resources/views', resource_path('views/auth/${guard}'));
    }

    private function createNotifications()
    {
        $notifications = [
            'password-reset' => ['ResetPasswordNotification.php'],
            'email-verification' => ['SendEmailVerificationNotification.php'],
        ];

        $this->copyFiles($notifications,  __DIR__ . '/../../Notifications', app_path('Notifications/Auth/${namespace}'));
    }

    private function createMigrations()
    {
        $migrations = [
            'authentication' => ['2014_10_12_000000_create_${table}_table.php'],
            'password-reset' => ['2014_10_12_000000_create_${table}_password_reset_table.php'],
        ];

        $this->copyFiles($migrations,  __DIR__ . '/../../../migrations', database_path('migrations'));
    }

    private function copyFiles($resources, $origin, $destination)
    {
        $this->iterateConfig(function ($config) use ($resources, $origin, $destination) {
            foreach ($resources as $group => $files) {
                if (!in_array($group, $config['groups'])) continue;
                foreach ($files as $file) {
                    $content = file_get_contents("$origin/$file");
                    $content = $this->replaceConfig($content, $config['guard']); //replace wildcards inside the file
                    $destination = $this->replaceConfig($destination, $config['guard']); //replace wildcards in file name
                    $file = $this->replaceConfig($file, $config['guard']); //replace wildcards in file name
                    $this->putContent($destination, $file, $content);
                }
            }
        });
    }

    private function getConfig($guard, $key=null)
    {
        $namespace = config("kameauth.namespaces.$guard", Str::studly($guard));
        $table = config("kameauth.tables.$guard", Str::plural(Str::lower($guard)));
        $prefix = config("kameauth.routes.$guard.prefix", $guard);
        $route = config("kameauth.routes.$guard.name", $guard);
        $view = config("kameauth.views.$guard", $guard);
        $model = config("auth.providers.$guard.model", '\App\User');
        $groups = config("kameauth.routes.$guard.groups", ['authentication', 'registration', 'password-reset']);
        if (!is_array($groups)) $groups = [groups];

        $response = compact('namespace', 'table', 'prefix', 'route', 'view', 'model', 'groups', 'guard');

        if ($key) $response = $response[$key];

        return $response;
    }

    private function replaceConfig($text, $guard)
    {
        extract($this->getConfig($guard));

        $text = str_replace('${namespace}', $namespace, $text);
        $text = str_replace('${table}', $table, $text);
        $text = str_replace('${prefix}', $prefix, $text);
        $text = str_replace('${route}', $route, $text);
        $text = str_replace('${view}', $view, $text);
        $text = str_replace('${model}', $model, $text);
        $text = str_replace('${guard}', $guard, $text);

        $migrationName = \Str::plural($namespace);
        $text = str_replace('${migrationName}', $migrationName, $text);

        return $text;
    }

    private function iterateConfig($callback)
    {
        $guards = config('auth.guards');

        foreach ($guards as $guard => $guardOptions) {
            if ($guardOptions['driver'] != 'session') continue;
            $callback($this->getConfig($guard));
        }
    }

    private function putContent($path, $file, $content)
    {
        if (!is_dir($path)) mkdir($path, 0755, true);
        file_put_contents("$path/$file", $content);
    }
}

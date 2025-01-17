<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    |
    | From here you can configure how the routes will be generated for each guard.
    |
    | The prefix key can be modified to prefix each path in the auth group.
    | For example the backoffice prefix will generate routes of type /backoffice/login
    |
    | The name key allows you to control the prefix that will be used when creating the named routes for the auth routes.
    | The value user will create named routes such as: route('user.login')
    |
    | Finally, from the groups you can configure the logic for each guard.
    | Bypassing a group prevents the creation of views and controllers associated with it.
    | This guarantees greater security.
    | Supported: "authentication", "registration", "password-reset", "email-verification"
    */

    'routes' => [
        'user' => [
            'prefix' => 'profile',
            'name' => 'user',
            'groups' => ['authentication', 'password-reset', 'email-verification']
        ],
        'admin' => [
            'prefix' => 'admin', //admin.home
            'name' => 'admin',
            'groups' => ['authentication', 'password-reset']
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Controllers Namespaces
    |--------------------------------------------------------------------------
    |
    | If you want more precise control over the namespace of your controllers you can do it from here.
    |
    | You can specify a custom namespace for each guard.
    |
    | For example the value Admin will generate namespaces with the following format: App\Http\Controllers\Auth\Admin
    |
    | It is important to note that the base of the namespace cannot be modified.
    | This configuration is not mandatory and if the default namespace is omitted it will be created 
    | by applying the Str::studly method to the name of the guard.
    */

    'namespaces' => [
        'user' => 'User',
    ],

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    |
    | By default kameauth creates the authentication views in a subfolder named the same as the guard.
    |
    | If you want to modify this behavior you can do it from here.
    |
    | In either case, the root folder will always be /views/auth
    |
    */

    'views' => [
        'user' => 'user',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tables
    |--------------------------------------------------------------------------
    |
    | TODO:
    |
    */

    'tables' => [
        'user' => 'users',
    ],

];

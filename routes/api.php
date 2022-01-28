<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group([
    'prefix' => 'user',
], function () use ($router) {
    $router->post('register', ['as' => 'user.register', 'uses' => 'UserController@register']);

    $router->post('sign-in', ['as' => 'auth.sign-in', 'uses' => 'AuthController@signIn']);
    $router->post('recover-password', ['as' => 'password.recover', 'uses' => 'AuthController@generateResetToken']);
    $router->put('resetpassword', ['as' => 'password.reset', 'uses' => 'AuthController@resetPassword']);

    $router->group([
        'middleware' => ['auth'],
    ], function () use ($router) {
        $router->get('companies', ['as'=> 'user.companies', 'uses' => 'CompanyController@index']);
    });
});


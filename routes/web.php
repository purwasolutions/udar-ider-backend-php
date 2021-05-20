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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    return \Illuminate\Support\Str::random(32);
});

$router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function () use ($router) {
    $router->group(['prefix' => 'roles'], function () use ($router) {
        $router->post('/', 'RoleController@store');
        $router->get('/', 'RoleController@findAll');
        $router->get('/{id}', 'RoleController@findById');
        $router->put('/{id}', 'RoleController@update');
        $router->delete('/{id}', 'RoleController@delete');
    });

    $router->group(['prefix' => 'users', 'middleware' => 'firebase'], function () use ($router) {
        $router->post('/', 'UserController@store');
        $router->get('/', 'UserController@findAll');
        $router->get('/{id}', 'UserController@findById');
        $router->put('/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@delete');
    });
});

$router->post('/user', 'UserController@register');
$router->group(['prefix' => 'user', 'middleware' => 'firebase'], function () use ($router) {
    $router->get('/', 'UserController@currentUser');    
    $router->put('/', 'UserController@update');
});

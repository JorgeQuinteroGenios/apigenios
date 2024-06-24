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

$router->post('/auth/login', [
    'uses' => 'AuthController@authenticate'
]);

$router->group(
    ['middleware' => 'jwt_auth'],
    function () use ($router){
        $router->get('/users', 'UserController@index');
        $router->get('/users/{id}', 'UserController@show');
        $router->delete('/users/{id}', 'UserController@destroy');
        $router->put('/users/{id}', 'UserController@update');
        $router->post('/users', 'UserController@store');
    }
);

$router->group(
    ['middleware' => CorsMiddleware::class],
    function () use ($router){
        $router->post('/stacks', 'StackController@store');
    }
);

$router->get('/', function(){
    return "Hola API";
});

$router->get('/developers', 'DeveloperController@index');
$router->get('/developers/{id}', 'DeveloperController@show');
$router->delete('/developers/{id}', 'DeveloperController@destroy');
$router->put('/developers/{id}', 'DeveloperController@update');
$router->post('/developers', 'DeveloperController@store');

$router->get('/categories', 'CategoryController@index');
$router->get('/categories/{id}', 'CategoryController@show');
$router->delete('/categories/{id}', 'CategoryController@destroy');
$router->put('/categories/{id}', 'CategoryController@update');
$router->post('/categories', 'CategoryController@store');

$router->get('/services', 'ServiceController@index');
$router->get('/services/{id}', 'ServiceController@show');
$router->delete('/services/{id}', 'ServiceController@destroy');
$router->put('/services/{id}', 'ServiceController@update');
$router->post('/services', 'ServiceController@store');

$router->get('/stacks', 'StackController@index');
$router->get('/stacks/{id}', 'StackController@show');
$router->delete('/stacks/{id}', 'StackController@destroy');
$router->put('/stacks/{id}', 'StackController@update');


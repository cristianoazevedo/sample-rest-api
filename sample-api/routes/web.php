<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return ['name' => config('app.name'), 'version' => '1.0.0'];
});


$router->group(['prefix' => 'api/v1'], function () use ($router) {
    /**
     * User rotes
     */
    $router->get('/users', 'UserController@index');
    $router->get('/user/{id}', 'UserController@find');
    $router->post('/user', 'UserController@create');
    $router->put('/user/{id}', 'UserController@update');
    /**
     * Transactions rotes
     */
    $router->post('/transaction', 'TransactionController@create');
});

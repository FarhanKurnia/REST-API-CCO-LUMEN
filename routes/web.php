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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
  // API route group with middleware (authorized)
  $router->group(['middleware' => 'auth'], function () use ($router) {
    // ==============[Endpoint Auth]==============
    // Matches "/api/logout
    $router->get('logout', 'AuthController@logout');

    // ==============[Endpoint User]==============
    // Matches "/api/user
    $router->put('user', 'UserController@update');
    // Matches "/api/user
    $router->get('user', 'UserController@show');
    // Matches "/api/user
    // $router->get('user', 'UserController@index');

    $router->group(['middleware' => 'role'], function () use ($router) {
        // ==============[Endpoint BTS]==============
        // Matches "/api/bts -> Show All
        $router->get('bts','BtsController@index');
        // Matches "/api/bts -> Store
        $router->post('bts','BtsController@store');
        // Matches "/api/bts/1 -> Show One
        $router->get('bts/{id}','BtsController@show');
        // Matches "/api/bts/1 -> Delete
        $router->delete('bts/{id}','BtsController@destroy');
        // Matches "/api/bts -> Update
        $router->put('bts/{id}','BtsController@update');
    });
    // ==========================================

    // ==============[Endpoint BTS]==============


  });

  // Matches "/api/register
  $router->post('register', 'AuthController@register');
  // Matches "/api/login
  $router->post('login', 'AuthController@login');


  // Just testing route to get JWT Payload
  $router->get('getJWT', 'UserController@getJWT');
  // $router->get('profile', 'UserController@profile');
});

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
        // API route group with middleware (Admin)
        $router->group(['middleware' => 'role'], function () use ($router) {
            // ==============[Endpoint POP]==============
            // Matches "/api/pop -> Store
            $router->post('shift','ShiftController@store');
            // // Matches "/api/pop -> Index
            $router->get('shift','ShiftController@index');
            // Matches "/api/pop/id -> Show One
            $router->get('shift/{id}','ShiftController@show');
            // Matches "/api/pop/id -> Update
            $router->put('shift/{id}','ShiftController@update');
            // Matches "/api/pop/id -> Delete
            $router->delete('shift/{id}','ShiftController@destroy');

            // ==============[Endpoint BTS Admin]==============
            // Matches "/api/bts -> Store
            $router->post('bts','BtsController@store');
            // Matches "/api/bts/1 -> Show One
            $router->delete('bts/{id}','BtsController@destroy');
            // Matches "/api/bts/1 -> Update
            $router->put('bts/{id}','BtsController@update');

            // ==============[Endpoint Role]==============
            // Matches "/api/role -> Store
            $router->post('role','RoleController@store');
            // // Matches "/api/role -> Index
            $router->get('role','RoleController@index');
            // Matches "/api/role/id -> Show One
            $router->get('role/{id}','RoleController@show');
            // Matches "/api/role/id -> Update
            $router->put('role/{id}','RoleController@update');
            // Matches "/api/role/id -> Delete
            $router->delete('role/{id}','RoleController@destroy');

            // ==============[Endpoint POP]==============
            // Matches "/api/pop -> Store
            $router->post('pop','POPController@store');
            // // Matches "/api/pop -> Index
            // $router->get('pop','POPController@index');
            // Matches "/api/pop/id -> Show One
            $router->get('pop/{id}','POPController@show');
            // Matches "/api/pop/id -> Update
            $router->put('pop/{id}','POPController@update');
            // Matches "/api/pop/id -> Delete
            $router->delete('pop/{id}','POPController@destroy');

             // ==============[Endpoint Sumber Keluhan]==============
            // Matches "/api/pop -> Store
            $router->post('sumber-keluhan','SumberKeluhanController@store');
            // Matches "/api/pop -> Index
            $router->get('sumber-keluhan','SumberKeluhanController@index');
            // Matches "/api/pop/id -> Show One
            $router->get('sumber-keluhan/{id}','SumberKeluhanController@show');
            // Matches "/api/pop/id -> Update
            $router->put('sumber-keluhan/{id}','SumberKeluhanController@update');
            // Matches "/api/pop/id -> Delete
            $router->delete('sumber-keluhan/{id}','SumberKeluhanController@destroy');


            // ==============[Endpoint User]==============
            // Matches "/api/user
            $router->get('user', 'UserController@index');
            // Matches "/api/user
            $router->put('user/{id}', 'UserController@edit');
            // Matches "/api/user
            $router->delete('user/{id}', 'UserController@destroy');
        });
        // API route group with middleware (All Role: Admin || Helpdesk || NOC)
        // ==============[Endpoint Auth]==============
            // Matches "/api/logout
            $router->get('logout', 'AuthController@logout');

        // ==============[Endpoint User]==============
        // Matches "/api/profile
        $router->put('profile', 'UserController@update');
        // Matches "/api/profile
        $router->get('profile', 'UserController@show');

        // ==============[Endpoint BTS]==============
        // Matches "/api/bts -> Show All
        $router->get('bts','BtsController@index');
        // Matches "/api/bts/1 -> Show One
        $router->get('bts/{id}','BtsController@show');

        // // ==============[Endpoint Keluhan]==============
        // // Matches "/api/keluhan -> Show All
        // $router->get('keluhan','KeluhanController@index');
        // // Matches "/api/keluhan -> Store
        // $router->post('keluhan','KeluhanController@store');
        // // Matches "/api/keluhan/1 -> Show One
        // $router->get('keluhan/{id}','KeluhanController@show');
        // // Matches "/api/keluhan/1 -> Delete
        // $router->delete('keluhan/{id}','KeluhanController@destroy');
        // // Matches "/api/keluhan -> Update
        // $router->put('keluhan/{id}','KeluhanController@update');

        // ==============[Endpoint Balasan]==============
        // Matches "/api/balasan -> Index
        $router->get('balasan','BalasanController@index');
        // Matches "/api/balasan -> Store
        $router->post('balasan','BalasanController@store');
        // Matches "/api/balasan/1 -> Show One
        $router->get('balasan/{id}','BalasanController@show');

         // ==============[Endpoint Keluhan]==============
        // Matches "/api/keluhan -> Show All
        $router->get('keluhan','KeluhanController@index');
        // Matches "/api/keluhan -> Store
        $router->post('keluhan','KeluhanController@store');
        // Matches "/api/keluhan/1 -> Show One
        $router->get('keluhan/{id}','KeluhanController@show');
        // Matches "/api/keluhan/1 -> Delete
        $router->delete('keluhan/{id}','KeluhanController@destroy');
        // Matches "/api/keluhan -> Update
        $router->put('keluhan/{id}','KeluhanController@update');
        // Matches "/api/keluhan -> close
        $router->put('close/{id}','KeluhanController@close');
        // Matches "/api/keluhan -> open
        $router->put('open/{id}','KeluhanController@open');
        // Matches "/api/keluhan -> history
        $router->get('history','KeluhanController@history');
        // Matches "/api/keluhan -> search history
        $router->post('search-history','KeluhanController@search');

        // ==============[Endpoint RFO Keluhan]==============
        // Matches "/api/balasan -> Index
        $router->get('rfo-keluhan','RFOKeluhanController@index');
        // Matches "/api/balasan -> Store
        $router->post('rfo-keluhan','RFOKeluhanController@store');
        // Matches "/api/balasan/1 -> Show One
        $router->get('rfo-keluhan/{id}','RFOKeluhanController@show');
        // Matches "/api/balasan/1 -> Update
        $router->put('rfo-keluhan/{id}','RFOKeluhanController@update');

        // ==============[Endpoint RFO Gangguan]==============
        // Matches "/api/balasan -> Index
        $router->get('rfo-gangguan','RFOGangguanController@index');
        // Matches "/api/balasan -> Store
        $router->post('rfo-gangguan','RFOGangguanController@store');
        // Matches "/api/balasan/1 -> Show One
        $router->get('rfo-gangguan/{id}','RFOGangguanController@show');
        // Matches "/api/balasan/1 -> Update
        $router->put('rfo-gangguan/{id}','RFOGangguanController@update');
        // Matches "/api/keluhan -> search history
        $router->post('search-RFOGangguan','RFOGangguanController@search');
        // Matches "/api/balasan/1 -> Update
        $router->put('keluhan-rfo-gangguan/{id}','KeluhanController@updateKeluhanRFOGangguan');




  });

  // Matches "/api/register
  $router->post('register', 'AuthController@register');
  // Matches "/api/login
  $router->post('login', 'AuthController@login');


  // Just testing route to get JWT Payload
    $router->get('getJWT', 'UserController@getJWT');
  // $router->get('profile', 'UserController@profile');
  // Matches "/api/role -> Index
  $router->get('role/public','RoleController@indexPublic');
  // Matches "/api/pop -> Index
  $router->get('pop','POPController@index');
});

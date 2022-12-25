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

// API route group prefix API
$router->group(['prefix' => 'api'], function () use ($router) {
  // API route group with middleware (Authorized)
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // API route group with middleware (User Verified)
        $router->group(['middleware' => 'verifikasi'], function () use ($router) {
            // API route group with middleware (Admin Only)
            $router->group(['middleware' => 'role'], function () use ($router) {
                // ==============[Endpoint SHIFT]==============
                // Matches localhost:8000/api/shift -> Store
                $router->post('shift','ShiftController@store');
                // Matches localhost:8000/api/shift/{id} -> Show
                $router->get('shift/{id}','ShiftController@show');
                // Matches localhost:8000/api/shift/{id} -> Update
                $router->put('shift/{id}','ShiftController@update');
                // Matches localhost:8000/api/shift/{id} -> Delete
                $router->delete('shift/{id}','ShiftController@destroy');

                // ==============[Endpoint BTS]==============
                // Matches localhost:8000/api/bts -> Store
                $router->post('bts','BtsController@store');
                // Matches localhost:8000/api/bts/{id} -> Delete
                $router->delete('bts/{id}','BtsController@destroy');
                // Matches localhost:8000/api/bts/{id} -> Update
                $router->put('bts/{id}','BtsController@update');

                // ==============[Endpoint ROLE]==============
                // Matches localhost:8000/api/role -> Store
                $router->post('role','RoleController@store');
                // Matches localhost:8000/api/role/{id} -> Show
                $router->get('role/{id}','RoleController@show');
                // Matches localhost:8000/api/role/{id} -> Update
                $router->put('role/{id}','RoleController@update');
                // Matches localhost:8000/api/role/{id} -> Delete
                $router->delete('role/{id}','RoleController@destroy');

                // ==============[Endpoint POP]==============
                // Matches localhost:8000/api/pop -> Store
                $router->post('pop','POPController@store');
                // Matches localhost:8000/api/pop/{id} -> Show
                $router->get('pop/{id}','POPController@show');
                // Matches localhost:8000/api/pop/{id} -> Update
                $router->put('pop/{id}','POPController@update');
                // Matches localhost:8000/api/pop/{id} -> Delete
                $router->delete('pop/{id}','POPController@destroy');

                // ==============[Endpoint SUMBER KELUHAN]==============
                // Matches localhost:8000/api/sumber-keluhan -> Store
                $router->post('sumber-keluhan','SumberKeluhanController@store');
                // Matches localhost:8000/api/sumber-keluhan/{id} -> Show
                $router->get('sumber-keluhan/{id}','SumberKeluhanController@show');
                // Matches localhost:8000/api/sumber-keluhan/{id} -> Update
                $router->put('sumber-keluhan/{id}','SumberKeluhanController@update');
                // Matches localhost:8000/api/sumber-keluhan/{id} -> Delete
                $router->delete('sumber-keluhan/{id}','SumberKeluhanController@destroy');


                // ==============[Endpoint USER]==============
                // Matches localhost:8000/api/user -> Store
                $router->get('user', 'UserController@index');
                // Matches localhost:8000/api/user/{id} -> Show
                $router->get('user/{id}', 'UserController@show');
                // Matches localhost:8000/api/user/{id} -> Update
                $router->put('user/{id}', 'UserController@update');
                // Matches localhost:8000/api/user/{id} -> Delete
                $router->delete('user/{id}', 'UserController@destroy');
            });


            // API route group with middleware (All Role: Admin || Helpdesk || NOC)
            // ==============[Endpoint AUTH]==============
            // Matches localhost:8000/api/logout -> Log Out
            $router->get('logout', 'AuthController@logout');

            // ==============[Endpoint ROLE]==============
            // Matches localhost:8000/api/role -> Index
            $router->get('role','RoleController@index');

            // ==============[Endpoint USER]==============
            // Matches localhost:8000/api/change-password -> Update Password
            $router->put('change-password', 'UserController@changePassword');
            // Matches localhost:8000/api/profileAvatar -> Post Avatar Profile
            $router->post('profileAvatar', 'UserController@updateAvatar');
            // Matches localhost:8000/api/profile -> Profile by JWT
            $router->get('profile', 'UserController@profile');

            // ==============[Endpoint BTS]==============
            // Matches localhost:8000/api/bts -> Index
            $router->get('bts','BtsController@index');
            // Matches localhost:8000/api/bts/{id} -> Show
            $router->get('bts/{id}','BtsController@show');

            // ==============[Endpoint BALASAN]==============
            // Matches localhost:8000/api/balasan -> Index
            $router->get('balasan','BalasanController@index');
            // Matches localhost:8000/api/balasan -> Store
            $router->post('balasan','BalasanController@store');
            // Matches localhost:8000/api/balasan/{id} -> Show
            $router->get('balasan/{id}','BalasanController@show');
            // Matches localhost:8000/api/lampiran-balasan -> Store
            $router->post('lampiran-balasan','LampiranBalasanController@store');
            // Matches localhost:8000/api/lampiran-balasan -> Index
            $router->get('lampiran-balasan','LampiranBalasanController@index');

            // ==============[Endpoint KELUHAN]==============
            // Matches localhost:8000/api/keluhan -> Index
            $router->get('keluhan','KeluhanController@index');
            // Matches localhost:8000/api/keluhan -> Store
            $router->post('keluhan','KeluhanController@store');
            // Matches localhost:8000/api/keluhan/{id} -> Show
            $router->get('keluhan/{id}','KeluhanController@show');
            // Matches localhost:8000/api/keluhan/{id} -> Delete
            $router->delete('keluhan/{id}','KeluhanController@destroy');
            // Matches localhost:8000/api/keluhan/{id} -> Update
            $router->put('keluhan/{id}','KeluhanController@update');
            // Matches localhost:8000/api/close/{id} -> Close
            $router->put('close/{id}','KeluhanController@close');
            // Matches localhost:8000/api/open/{id} -> Open
            $router->put('open/{id}','KeluhanController@open');
            // Matches localhost:8000/api/history -> Index
            $router->get('history','KeluhanController@history');
            // Matches localhost:8000/api/search-history -> Search
            $router->post('search-history','KeluhanController@search');
            // Matches localhost:8000/api/lampiran-keluhan -> Store
            $router->post('lampiran-keluhan','LampiranKeluhanController@store');
            // Matches localhost:8000/api/lampiran-keluhan -> Index
            $router->get('lampiran-keluhan','LampiranKeluhanController@index');

            // ==============[Endpoint RFO KELUHAN]==============
            // Matches localhost:8000/api/rfo-keluhan -> Index
            $router->get('rfo-keluhan','RFOKeluhanController@index');
            // Matches localhost:8000/api/rfo-keluhan -> Store
            $router->post('rfo-keluhan','RFOKeluhanController@store');
            // Matches localhost:8000/api/rfo-keluhan/{id} -> Show
            $router->get('rfo-keluhan/{id}','RFOKeluhanController@show');
            // Matches localhost:8000/api/rfo-keluhan/{id} -> Update
            $router->put('rfo-keluhan/{id}','RFOKeluhanController@update');
            // Matches localhost:8000/api/rfo-keluhan/{id} -> Delete
            $router->delete('rfo-keluhan/{id}','RFOKeluhanController@destroy');
            // Matches localhost:8000/api/keluhan-rfo-keluhan/{id} -> Update RFO @ Keluhan Field
            $router->put('keluhan-rfo-keluhan/{id}','KeluhanController@updateKeluhanRFOKeluhan');

            // ==============[Endpoint RFO GANGGUAN]==============
            // Matches localhost:8000/api/rfo-gangguan -> Index
            $router->get('rfo-gangguan','RFOGangguanController@index');
            // Matches localhost:8000/api/rfo-gangguan -> Store
            $router->post('rfo-gangguan','RFOGangguanController@store');
            // Matches localhost:8000/api/rfo-gangguan/{id} -> Show
            $router->get('rfo-gangguan/{id}','RFOGangguanController@show');
            // Matches localhost:8000/api/rfo-gangguan/{id} -> Update
            $router->put('rfo-gangguan/{id}','RFOGangguanController@update');
            // Matches localhost:8000/api/rfo-gangguan/{id} -> Search
            $router->post('search-RFOGangguan','RFOGangguanController@search');
            // Matches localhost:8000/api/keluhan-rfo-gangguan/{id} -> Delete
            $router->delete('rfo-gangguan/{id}','RFOGangguanController@destroy');
            // Matches localhost:8000/api/close-rfo-gangguan/{id} -> Close
            $router->put('close-rfo-gangguan/{id}','RFOGangguanController@close');
            // Matches localhost:8000/api/keluhan-rfo-gangguan/{id} -> Update RFO @ Gangguan Field
            $router->put('keluhan-rfo-gangguan/{id}','KeluhanController@updateKeluhanRFOGangguan');

            // ==============[Endpoint STATISTIK]==============
            // Matches localhost:8000/api/statistik -> Index
            $router->get('statistik','Statistik@index');
            // Matches localhost:8000/api/statistik-range?dari=YYYY-MM-DD&sampai=YYYY-MM-DD -> Range Statistik
            $router->get('statistik-range','Statistik@statistik_range');

            // ==============[Endpoint SUMBER KELUHAN]==============
            // Matches localhost:8000/api/sumber-keluhan -> Index
            $router->get('sumber-keluhan','SumberKeluhanController@index');

            // ==============[Endpoint SHIFT]==============
            // Matches localhost:8000/api/shift -> Index
            $router->get('shift','ShiftController@index');

            // ==============[Endpoint LAPORAN]==============
            // Matches localhost:8000/api/laporan -> Index
            $router->get('laporan','LaporanController@index');
            // Matches localhost:8000/api/laporan/{id} -> Show
            $router->get('laporan/{id}','LaporanController@show');
            // Matches localhost:8000/api/laporan -> Store
            $router->post('laporan','LaporanController@store');
            // Matches localhost:8000/api/laporan-keluhan -> Index Keluhan in Shift for storing to Laporan
            $router->post('laporan-keluhan','LaporanController@keluhanLaporan');
            // Matches localhost:8000/api/laporan-user -> Index User in Shift for storing to Laporan
            $router->get('laporan-user','LaporanController@userLaporan');

            // ==============[Endpoint NOTIFIKASI]==============
            // Matches localhost:8000/api/notifikasi -> Index
            $router->get('notifikasi','NotifikasiController@index');
            // Matches localhost:8000/api/notifikasi -> Store
            $router->post('notifikasi','NotifikasiController@store');
            // Matches localhost:8000/api/broadcast-notifikasi -> Broadcast Notifikasi
            $router->post('broadcast-notifikasi','NotifikasiController@broadcast');
            // Matches localhost:8000/api/read-broadcast -> Read Broadcast Notifikasi
            $router->post('read-notifikasi','NotifikasiController@read');
            // Matches localhost:8000/api/read-all-broadcast -> Read All Broadcast Notifikasi
            $router->get('read-all-notifikasi','NotifikasiController@read_all');
            // Matches localhost:8000/api/read-all-broadcast-keluhan -> Read All Broadcast Notifikasi in Keluhan
            $router->post('read-all-notifikasi-keluhan','NotifikasiController@read_all_one_case');
        });
    });

    // ==============[Endpoint AUTH]==============
    // Matches localhost:8000/api/register -> Register
    $router->post('register', 'AuthController@register');
    // Matches localhost:8000/api/login -> Login
    $router->post('login', 'AuthController@login');

    // ==============[Endpoint PUBLIC]==============
    // Matches localhost:8000/api/role-public -> Index Role Without Admin
    $router->get('role-public','RoleController@indexPublic');
    // Matches localhost:8000/api/pop -> Index
    $router->get('pop','POPController@index');

    // ==============[Endpoint Debug]==============
    // Just testing route to get JWT Payload
    $router->get('getJWT', 'UserController@getJWT');
    $router->get('/verification','AuthController@verification');
    $router->get('/otp','AuthController@requestOTP');
    $router->get('/forget-password','AuthController@forgetPassword');
});

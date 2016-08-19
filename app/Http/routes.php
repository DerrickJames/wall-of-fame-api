<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['middleware' => 'cors'], function ($api) {
        /*
         * Authentication
         */
        $api->group(['namespace' => 'App\Http\Controllers\Auth'], function ($api) {
            /* User login */
            $api->post('auth/login', 'AuthController@postLogin');

            $api->group(['middleware' => ['api.auth']], function ($api) {
                /* User logout */
                $api->post('auth/logout', 'AuthController@logout');

                /* Current User */
                $api->get('auth/user', 'AuthController@currentUser');
            });
        });
    });
});

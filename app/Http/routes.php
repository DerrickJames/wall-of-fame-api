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

            //$api->post('auth/social/login', 'AuthController@postSocialLogin');

            $api->group(['middleware' => ['jwt.auth']], function ($api) {
                /* User logout */
                $api->post('auth/logout', 'AuthController@logout');
            });
        });
    });
});

<?php

use Illuminate\Support\Str;

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

//(v1)
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    //route API verify and forgot
    $router->get('/verify/{tokenURL}/check', 'VerifyAndForgotPasswordControllers@checkVerify');
    $router->post('/forgot/password', 'VerifyAndForgotPasswordControllers@forgotPassword');
    $router->post('/change/{tokenURL}/password', 'VerifyAndForgotPasswordControllers@changePassword');
    $router->post('/verify/{tokenURL}/account', 'VerifyAndForgotPasswordControllers@verifyUsers');
    // route api public
    $router->group(['prefix' => 'web', 'namespace' => 'Web'], function () use ($router) {
        $router->group(['prefix' => 'kategori'], function () use ($router) {
            $router->get('/', 'LandingControllers@kategori');
            $router->post('/', 'LandingControllers@create_kategori');
        });
        $router->group(['prefix' => 'rekomendasi'], function () use ($router) {
            $router->get('/', 'LandingControllers@rekomendasi');
            $router->post('/', 'LandingControllers@create_rekomendasi');
        });
        $router->group(['prefix' => 'sponsor'], function () use ($router) {
            $router->get('/', 'LandingControllers@sponsor');
            $router->post('/', 'LandingControllers@create_sponsor');
        });
        $router->group(['prefix' => 'articles'], function () use ($router) {
            $router->get('/', 'LandingControllers@articles');
            $router->post('/', 'LandingControllers@create_articles');
        });
        $router->group(['prefix' => 'diskon'], function () use ($router) {
            $router->get('/', 'LandingControllers@diskon');
            $router->post('/', 'LandingControllers@create_diskon');
        });
    });

    //private api 
    //feature users
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->group(['prefix' => 'auth'], function () use ($router) {
            $router->post('login', 'AuthUsersControllers@login');
            $router->post('register', 'AuthUsersControllers@register');
            $router->group(['prefix' => 'logout', 'middleware' => ['auth:user', 'user']], function () use ($router) {
                $router->post('/', 'AuthUsersControllers@logout');
            });
        });
        $router->group(['middleware' => ['auth:user', 'user']], function () use ($router) {
            $router->group(['prefix' => 'profile'], function () use ($router) {
                $router->get('/', 'AuthUsersControllers@profile');
                $router->post('/', 'AuthUsersControllers@updateOrCreate');
            });
        });
    });

    // feature mentor
    $router->group(['prefix' => 'mentor', 'namespace' => 'Mentor'], function () use ($router) {
        $router->group(['prefix' => 'auth'], function () use ($router) {
            $router->post('login', 'AuthMentorControllers@login');
            $router->post('register', 'AuthMentorControllers@register');
            $router->group(['prefix' => 'logout', 'middleware' => ['auth:mentor', 'mentor']], function () use ($router) {
                $router->post('/', 'AuthMentorControllers@logout');
            });
        });
        $router->group(['middleware' => ['auth:mentor', 'mentor']], function () use ($router) {
            $router->group(['prefix' => 'room'], function () use ($router) {
                $router->get('/', 'MentorshipControllers@room');
                $router->post('/', 'MentorshipControllers@createRoom');
                $router->post('/message', 'MentorshipControllers@sendMessageRoom');
            });
        });
    });

    //feature admin
    $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function () use ($router) {
        $router->group(['prefix' => 'auth'], function () use ($router) {
            $router->post('login', 'AuthAdminControllers@login');
            $router->post('register', 'AuthAdminControllers@register');
            $router->group(['prefix' => 'logout', 'middleware' => ['auth:admin', 'admin']], function () use ($router) {
                $router->post('/', 'AuthAdminControllers@logout');
            });
        });

        $router->group(['middleware' => ['auth:admin', 'admin']], function () use ($router) {
            $router->group(['prefix' => 'fitur-admin'], function () use ($router) {
                $router->post('/', function () {
                    return 'welcome feat admin';
                });
            });
        });
    });
});

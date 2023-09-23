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

$router->get('all', 'DummyController@index');

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

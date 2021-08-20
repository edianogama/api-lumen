<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
    Login via usuario e senha;
    Uma pagina de notícias, pública;
    Uma página de eventos, fechada, somente para usuários conectados
    Conteúdo fictício
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'Api\AuthController@register');
    $router->post('login', 'Api\AuthController@login');

    // "/api/news - public
    $router->get('news', 'Api\NewsController@index');

    //"/api/news - private
    $router->get('events', ['middleware' => 'auth', 'uses'  => 'Api\EventController@index']);

 });
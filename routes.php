<?php

declare(strict_types=1);

/**
 * @var Core\Router $router
 */
$router->add('/', 'GET', 'HomeController@index');
$router->add('/posts', 'GET', 'PostController@index');
$router->add('/posts/{id}', 'GET', 'PostController@show');
$router->add('/login', 'GET', 'AuthController@create');
$router->add('/login', 'POST', 'AuthController@store');
$router->add('/logout', 'POST', 'AuthController@destroy');

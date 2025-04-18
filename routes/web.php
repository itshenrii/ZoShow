<?php
$router->get('/', 'SiteController@home');

$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');
$router->get('/cadastro', 'AuthController@register');
$router->post('/cadastro', 'AuthController@register');

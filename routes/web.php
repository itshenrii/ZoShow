<?php
$router->get('/', 'SiteController@home');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@loginPost');

$router->get('/cadastro', 'AuthController@register');
$router->post('/cadastro', 'AuthController@registerPost');

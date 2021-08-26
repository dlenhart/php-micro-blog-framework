<?php

/* ----------------------------
|
|  Routes
|
|  Define your routes here.
|
|
| ----------------------------*/

$router->get('', 'HomeController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->get('post', 'PostController@post');
$router->post('example', 'PagesController@example');

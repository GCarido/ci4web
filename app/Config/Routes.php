<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/homepage', 'Home::homepage');

$routes->get('/homepage/(:any)', 'Home::user/$1');

$routes->get('/product', 'Home::product');

$routes->get('/edit/(:any)', 'Home::edit/$1');

$routes->post('/update', 'Home::update');

$routes->match(['get', 'post'], '/register', 'AccountController::register');
$routes->match(['get', 'post'], '/store', 'AccountController::store');
$routes->match(['get', 'post'], '/signin', 'AccountController::signin');
$routes->match(['get', 'post'], '/auth', 'AccountController::auth');
$routes->match(['get', 'post'], '/verify/(:any)', 'AccountController::verify/$1');



$routes->setAutoRoute(true);



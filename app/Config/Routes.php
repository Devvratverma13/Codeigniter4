<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->get('/signup','UserController::signup');
// $routes->get('/login','UserController::login');
// // $routes->get('/dashboard','UserController::dashboard');
// $routes->get('/logout','UserController::logout');
// $routes->match(['get','post'], '/signup_action','UserController::signup_action');
// $routes->match(['get','post'], '/login_action','UserController::login_action');

$routes->get('admin','AdminController::login');
$routes->get('admin-forgot-password','AdminController::forgotPassword');
$routes->match(['get','post'],'dashboard','AdminPagination::dashboard');

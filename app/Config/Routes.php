<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Routes controller UserController
$routes->get('user', 'UserController::index');

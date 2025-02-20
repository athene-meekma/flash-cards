<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('/pack/create', 'Pack::create');
$routes->get('/pack/(:num)', 'Pack::view/$1');

$routes->post('/card/upsert', 'Pack::cardUpsert');
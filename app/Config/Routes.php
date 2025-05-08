<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('/pack/upsert', 'Pack::packUpsert');
$routes->get('/pack/(:num)', 'Pack::view/$1');
$routes->post('/pack/delete', 'Pack::packDelete');

$routes->post('/card/upsert', 'Pack::cardUpsert');
$routes->post('/card/delete', 'Pack::cardDelete');
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//REST
//Routes clientes
$routes->get('clientes','ClientesController::get');
$routes->post('clientes/create','ClientesController::create');
$routes->put('clientes/update/(:segment)','ClientesController::update/$1');
$routes ->delete('clientes/delete/(:segment)','ClientesController::delete/$1');


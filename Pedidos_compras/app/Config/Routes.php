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


//routes Pedidos
$routes->get('pedidos','PedidosController::get');
$routes->post('pedidos/create','PedidosController::create');
$routes->put('pedidos/update/(:segment)','PedidosController::update/$1');
$routes ->delete('pedidos/delete/(:segment)','PedidosController::delete/$1');

//Routes Produtos
$routes->get('produtos','ProdutosController::get');
$routes->post('produtos/create','ProdutosController::create');
$routes->put('produtos/update/(:segment)','ProdutosController::update/$1');
$routes ->delete('produtos/delete/(:segment)','ProdutosController::delete/$1');



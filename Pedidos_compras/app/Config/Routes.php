<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rotas para Clientes
$routes->group('clientes', function ($routes) {
    $routes->get('/', 'ClientesController::get'); // Obter todos os clientes
    $routes->get('(:segment)', 'ClientesController::getList/$1'); // Obter cliente por ID
    $routes->post('create', 'ClientesController::create');
    $routes->put('update/(:segment)', 'ClientesController::update/$1');
    $routes->delete('delete/(:segment)', 'ClientesController::delete/$1');
});

// Rotas para Pedidos
$routes->group('pedidos', function ($routes) {
    $routes->get('/', 'PedidosController::get');
    $routes->get('(:segment)', 'PedidosController::getList/$1');
    $routes->post('create', 'PedidosController::create');
    $routes->put('update/(:segment)', 'PedidosController::update/$1');
    $routes->delete('delete/(:segment)', 'PedidosController::delete/$1');
});

// Rotas para Produtos
$routes->group('produtos', function ($routes) {
    $routes->get('/', 'ProdutosController::get');
    $routes->get('(:segment)', 'ProdutosController::getList/$1');
    $routes->post('create', 'ProdutosController::create');
    $routes->put('update/(:segment)', 'ProdutosController::update/$1');
    $routes->delete('delete/(:segment)', 'ProdutosController::delete/$1');
});

// Rotas para ItemPedidos
$routes->group('item', function ($routes) {
    $routes->get('/', 'ItemPedidosController::get');
    $routes->get('(:segment)', 'ItemPedidosController::getList/$1');
    $routes->post('create', 'ItemPedidosController::create');
    $routes->put('update/(:segment)', 'ItemPedidosController::update/$1');
    $routes->delete('delete/(:segment)', 'ItemPedidosController::delete/$1');
});

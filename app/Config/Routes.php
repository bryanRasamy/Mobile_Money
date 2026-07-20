<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('operateur', ['filter' => ['auth', 'role:2']], function($routes) {
    $routes->get('prefixe/form', 'PrefixeController::index');
    $routes->post('prefixe/add', 'PrefixeController::ajouterPrefixe');
    $routes->get('prefixe/delete/(:num)', 'PrefixeController::supprimerPrefixe/$1');
});

$routes->get('logout', 'ClientController::logout');

$routes->get('loginClient', 'ClientController::index');

$routes->post('login/client', 'ClientController::login');



$routes->group('client', ['filter' => ['auth', 'role:1']], function ($routes) {
    $routes->get('dashboard', 'ClientController::dashboard');
    $routes->post('depot', 'ClientController::depot');
    $routes->post('retrait', 'ClientController::retrait');
    $routes->post('transfert', 'ClientController::transfert');
    $routes->get('historique', 'HistoriqueController::mesTransactions');
});


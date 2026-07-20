<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/loginOperateur', 'OperateurController::index');
$routes->post('/login/operateur', 'OperateurController::login');
$routes->get('/logout', 'OperateurController::logout');

$routes->group('operateur', ['filter' => ['auth', 'role:2']], function($routes) {
    $routes->get('prefixe/form', 'PrefixeController::index');
    $routes->post('prefixe/add', 'PrefixeController::ajouterPrefixe');
    $routes->get('prefixe/delete/(:num)', 'PrefixeController::supprimerPrefixe/$1');
});
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('operateur', ['filter' => ['auth', 'role:2']], function($routes) {
    $routes->get('prefixe/form', 'PrefixeController::index');
    $routes->post('prefixe/add', 'PrefixeController::ajouterPrefixe');
    $routes->get('prefixe/delete/(:num)', 'PrefixeController::supprimerPrefixe/$1');
});
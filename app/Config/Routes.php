<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/loginClient','ClientController::index');
$routes->post('/loginClient','ClientController::login' );
$routes->get('/loginOperateur', 'OperateurController::index');
$routes->post('/login/operateur', 'OperateurController::login');
$routes->get('/logout', 'OperateurController::logout');


$routes->group('operateur', ['filter' => ['auth', 'role:2']], function($routes) {
    $routes->get('prefixe/form', 'PrefixeController::index');
    $routes->post('prefixe/add', 'PrefixeController::ajouterPrefixe');
    $routes->get('prefixe/delete/(:num)', 'PrefixeController::supprimerPrefixe/$1');

    $routes->get('typeOperation/form', 'TypeOperationController::index');
    $routes->add('typeOperation/add', 'TypeOperationController::ajouterTypeOperation');

    $routes->get('situationGain', 'HistoriqueController::index');
}); 

$routes->group('client', ['filter' => ['auth','role:1']], function($routes){

    $routes->get('dashboard','ClientController::dashboard');

    $routes->post('depot','ClientController::depot');

    $routes->post('retrait','ClientController::retrait');

    $routes->post('transfert','ClientController::transfert');

    $routes->get('historique', 'HistoriqueController::mesTransactions');

});


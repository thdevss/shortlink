<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


$routes->resource('link', ['only' => ['create', 'index', 'delete']]);


$routes->get('/backoffice/login', 'Backoffice::login');
$routes->post('/backoffice/login', 'Backoffice::login');
$routes->get('/backoffice/logout', 'Backoffice::logout', ['filter' => 'authGuard']);

$routes->get('/backoffice/dashboard', 'Backoffice::dashboard', ['filter' => 'authGuard']);
$routes->get('/backoffice/link', 'Backoffice::link_lists', ['filter' => 'authGuard']);

$routes->get('/backoffice/link/(:num)', 'Backoffice::link_detail/$1', ['filter' => 'authGuard']);
// $routes->get('/backoffice/profile', 'Backoffice::user_profile', ['filter' => 'adminGuard']);

// $routes->get('/backoffice/admin/users', 'Backoffice::users_lists', ['filter' => 'adminGuard']);
// $routes->get('/backoffice/admin/users/(:num)', 'Backoffice::user_detail/$1', ['filter' => 'adminGuard']);


$routes->get('/(:alphanum)', 'Home::goToLink/$1');

// $routes->resource('viewer', ['only' => ['create']]);

// cli only
$routes->cli('generate_report', 'Cron::generate_report');

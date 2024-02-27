<?php

namespace Config;

$routes = Services::routes();

//use CodeIgniter\Router\RouteCollection;


if(is_file(SYSTEMPATH . 'Config/Routes.php')){
    require SYSTEMPATH . 'Config/Routes.php';
}


/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');


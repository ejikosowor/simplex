<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Response;

$routes = new RouteCollection();
$routes->add('home', new Route('/', array(
    '_controller' => 'App\Controllers\HomeController::index'
)));

return $routes;
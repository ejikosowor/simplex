<?php

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

use App\Simplex\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Reference;

$request = Request::createFromGlobals();

$container = include 'app/container.php';
$config = include 'app/config.php';
$database = include 'app/database.php';

$container->setParameter('routes', include 'app/routes.php');

$container->register('listener.string_response', App\Simplex\Listeners\StringResponseListener::class);
$container->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')))
;

$response = $container->get('framework')->handle($request);

$response->send();
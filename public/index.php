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

$response = $container->get('framework')->handle($request);

$response->send();
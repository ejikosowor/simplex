<?php

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\Reference;

$container = include 'app/container.php';
$request = $container->get('request');

$response = $container->get('framework')->handle($request);

$response->send();
<?php

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$container = include 'app/container.php';
$request = $container->get('request');

$response = $container->get('framework')->handle($request);

$response->send();
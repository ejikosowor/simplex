#!/usr/bin/env php

<?php

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$container = include 'app/container.php';

$application = $container->get('console');
$application->run();
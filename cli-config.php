<?php

// replace with file to your own project bootstrap
require_once __DIR__.'/public/index.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
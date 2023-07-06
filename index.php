<?php

require_once __DIR__ . '/vendor/autoload.php';

use System\Application;
use System\Container\ContainerClass;

$container = new ContainerClass;
$app = $container->resolveClass(Application::class);
$app->run();
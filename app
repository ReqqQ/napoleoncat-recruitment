#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config/bootstrap.php';

use NapoleonCat\Kernel;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$kernel = new Kernel('',false);
$kernel->boot();

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');

$container = $kernel->getContainer();
$application = $container->get(Application::class);
$application->run();
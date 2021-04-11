#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config/bootstrap.php';

use NapoleonCat\Kernel;
use Symfony\Component\Console\Application;

$kernel = new Kernel('',false);
$kernel->boot();

$container = $kernel->getContainer();
$application = $container->get(Application::class);
$application->run();
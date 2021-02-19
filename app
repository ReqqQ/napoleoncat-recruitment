#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config/bootstrap.php';

use Symfony\Component\Console\Application;
$application = new Application();

$application->add(
    new \NapoleonCat\Command\FeedScanner()
);

$application->run();
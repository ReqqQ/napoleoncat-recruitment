<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (!class_exists(Dotenv::class)) {
    throw new LogicException('Please run "composer require symfony/dotenv" to load the ".env.local" files configuring the application.');
}

if (\file_exists(__DIR__ . '/../.env')) {
    (new Dotenv(true))->loadEnv(__DIR__ . '/../.env');
}

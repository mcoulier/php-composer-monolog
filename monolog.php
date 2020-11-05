<?php
require_once 'vendor/autoload.php';
require_once 'buttons.html';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\NativeMailerHandler;

//CREATE LOGGER
$logger = new Logger('logs');

//GET MESSAGE & VALUE BUTTON
$message = $_GET['message'];
$type = $_GET['type'];

//VALUE BUTTON(type) DECIDES ACTION
switch ($type) {
    case 'DEBUG':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::DEBUG));
        $logger->pushHandler(new BrowserConsoleHandler(Logger::INFO));
        break;

    case 'INFO':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::INFO));
        $logger->pushHandler(new BrowserConsoleHandler(Logger::INFO));
        break;

    case 'NOTICE':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/info.log', Logger::NOTICE));
        $logger->pushHandler(new BrowserConsoleHandler(Logger::INFO));
        break;

    case 'WARNING':
        $logger->pushHandler(new StreamHandler(__DIR__ . '/warning.log', Logger::WARNING));
        break;

    case 'ERROR':
        $logger->pushHandler(new StreamHandler(__DIR__.'/critical.log', Logger::ERROR));
        break;

    case 'CRITICAL':
        $logger->pushHandler(new StreamHandler(__DIR__.'/critical.log', Logger::CRITICAL));
        break;

    case 'ALERT':
        $logger->pushHandler(new StreamHandler(__DIR__.'/critical.log', Logger::ALERT));
        break;

    case 'EMERGENCY':
        $logger->pushHandler(new StreamHandler(__DIR__.'/emergency.log', Logger::EMERGENCY));
}

$logger->$type($message);
$logger->pushHandler(new FirePHPHandler());


/*$infoLog->pushHandler(new BrowserConsoleHandler(Logger::INFO));
$infoLog->pushHandler(new FirePHPHandler());

$infoLog->info($infoMessage);

//WARNING LOGGER
$warningMessage = $_GET['message'];

$warningLog = new Logger('warning_logger');

$warningLog->pushHandler(new StreamHandler(__DIR__ . '/warning.log', Logger::WARNING));
$warningLog->pushHandler(new FirePHPHandler());

$warningLog->info($warningMessage);*/
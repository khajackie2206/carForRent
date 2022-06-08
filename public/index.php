<?php

session_start();

use Khanguyennfq\CarForRent\Core\Application;
use Khanguyennfq\CarForRent\Core\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new Request());
$app->run();

<?php

session_start();

use Khanguyennfq\CarForRent\app\Application;
use Khanguyennfq\CarForRent\core\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new Request());
$app->run();

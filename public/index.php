<?php

session_start();

use Khanguyennfq\CarForRent\Core\Application;
use Khanguyennfq\CarForRent\Core\Request;

error_reporting(E_ALL);
ini_set('display_errors',1);
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(new Request());
$app->run();

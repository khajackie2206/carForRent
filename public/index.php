<?php
use Khanguyennfq\CarForRent\Application;
require_once __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../src/route.php';
$app = new Application();
$app->run();

<?php
session_start();

use Khanguyennfq\CarForRent\app\Application;
use Khanguyennfq\CarForRent\core\Request;
require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$app = new Application(new Request());
$app->run();

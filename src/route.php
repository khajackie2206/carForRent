<?php

namespace Khanguyennfq\CarForRent;

use Khanguyennfq\CarForRent\controller\CarController;
use Khanguyennfq\CarForRent\controller\LoginController;
use Khanguyennfq\CarForRent\controller\RegisterController;
use Khanguyennfq\CarForRent\controller\UserController;
use Khanguyennfq\CarForRent\core\Route;

Route::get('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logOut']);
Route::get('/', [CarController::class, 'index']);
Route::get('/signup', [RegisterController::class, 'index']);
Route::post('/signup', [RegisterController::class,'store']);
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class, 'logOut']);

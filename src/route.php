<?php

namespace Khanguyennfq\CarForRent;

use Khanguyennfq\CarForRent\controller\CarController;
use Khanguyennfq\CarForRent\controller\LoginController;
use Khanguyennfq\CarForRent\controller\RegisterController;
use Khanguyennfq\CarForRent\controller\UserController;

Route::get('/login', [new LoginController(), 'index']);
Route::get('/logout', [new LoginController(), 'logOut']);
Route::get('/', [new CarController(), 'index']);
Route::get('/signup', [new RegisterController(), 'index']);
Route::post('/signup', [new RegisterController(),'store']);
Route::post('/login', [new LoginController(),'login']);

<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;
use Khanguyennfq\CarForRent\database\DatabaseConnect;

class CarController
{
    /**
     * @return false|string
     */
    public function index(): View
    {
        return View::render('HomePage');
    }
}

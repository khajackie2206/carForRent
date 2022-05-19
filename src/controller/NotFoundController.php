<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\app\View;

class NotFoundController
{
    /**
     * @return string
     */
    public function index(): string
    {
        return View::render('NotFoundPage');
    }
}

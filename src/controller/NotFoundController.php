<?php

namespace Khanguyennfq\CarForRent\controller;
use Khanguyennfq\CarForRent\core\Response;
class NotFoundController extends BaseController
{
    public const INDEX_ACTION = 'index';


    public function index(): Response
    {
        return $this->response->view("NotFoundPage" );
    }
}

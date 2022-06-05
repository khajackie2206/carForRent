<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;

class NotFoundController extends BaseController
{
    public const INDEX_ACTION = 'index';

    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }
    public function index(): Response
    {
        return $this->response->view("NotFoundPage");
    }
}

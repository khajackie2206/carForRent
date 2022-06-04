<?php

namespace Khanguyennfq\CarForRent\controller;

use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;

abstract class BaseController
{
    protected Request $request;
    protected Response $response;

    /**
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}

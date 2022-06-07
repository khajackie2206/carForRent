<?php

namespace Khanguyennfq\CarForRent\Controller;

use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Core\Response;

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

<?php

namespace Khanguyennfq\CarForRent\controller\API;
use Khanguyennfq\CarForRent\core\Response;
use Khanguyennfq\CarForRent\core\Request;
class AbstractAPIController
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
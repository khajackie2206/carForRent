<?php

namespace Khanguyennfq\CarForRent\controller;
use Khanguyennfq\CarForRent\core\Request;
use Khanguyennfq\CarForRent\core\Response;

class RegisterController
{
    private $request;
    private $response;
    public function __construct(Request $request, Response $response)
    {
    $this->request = $request;
    $this->response = $response;
    }

    public function index(): Response
    {
        return $this->response->view('Register');
    }
}

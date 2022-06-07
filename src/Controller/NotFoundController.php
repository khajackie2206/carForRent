<?php

namespace Khanguyennfq\CarForRent\Controller;

use Khanguyennfq\CarForRent\Core\Request;
use Khanguyennfq\CarForRent\Core\Response;

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

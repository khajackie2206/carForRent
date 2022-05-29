<?php

namespace Khanguyennfq\CarForRent\controller;
use Khanguyennfq\CarForRent\core\Response;
class NotFoundController extends BaseController
{
    public const INDEX_ACTION = 'index';


    public function index(): Response
    {
        $template = "NotFoundPage.php";
        return $this->response->view($template, [], Response::HTTP_NOT_FOUND );
    }
}

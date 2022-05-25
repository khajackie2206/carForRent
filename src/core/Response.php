<?php

namespace Khanguyennfq\CarForRent\core;

class Response
{
    protected int $statusCode;
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }
}

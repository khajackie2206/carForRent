<?php

namespace Khanguyennfq\CarForRent\service;

class Validator
{
    private array $request;
    private array $rule;
    private array $message;

    /**
     * @param array $request
     * @param array $rule
     * @param array $message
     */
    public function __construct(array $request, array $rule, array $message)
    {
        $this->request = $request;
        $this->rule = $rule;
        $this->message = $message;
    }
}

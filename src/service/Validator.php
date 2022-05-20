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

    public function validate(): bool | array
    {
        $error = array();
        foreach ($this->request as $key => $value) {
            foreach ($this->rule["$key"] as $name => $rule) {
                switch ($rule) {
                    case 'required':
                        $message = $this->message ? $this->message["$rule"] : "$key is $rule";
                        if (empty($value)) {
                            array_push($error, $message);
                        }
                        break;
                    default:
                        echo "Not support " . $rule . " rule!";
                }
            }
        }
        if (!empty($error)) {
            return $error;
        }
        return true;
    }
}

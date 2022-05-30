<?php

namespace Khanguyennfq\CarForRent\core;

class Request
{
    const methodGet = "GET";
    const methodPost = "POST";
    const methodPut = "PUT";
    const methodDelete = "DELETE";

    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        if (!strpos($path, '?')) {
            return $path;
        }
        return substr($path, 0, strpos($path, '?'));
    }
    public function getHost(): string
    {
        return $_SERVER['HTTP_HOST'];
    }
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    public function getFormParams()
    {
        return $_REQUEST;
    }
    public function isPost(): bool
    {
        return $this->getMethod() == 'POST';
    }
    public function isGet(): bool
    {
        return $this->getMethod() == 'GET';
    }

    public function getBody(): array
    {
        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    public function getFiles()
    {
        return $_FILES;
    }

    public function getRequestJsonBody()
    {
        $data = file_get_contents('php://input');
        return json_decode($data, true);
    }
}

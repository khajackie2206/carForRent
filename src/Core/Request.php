<?php

namespace Khanguyennfq\CarForRent\Core;

class Request
{
    const methodGet = "GET";
    const methodPost = "POST";

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

    /**
     * @return string
     */
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

    /**
     * @return array
     */
    public function getFormParams()
    {
        return $_REQUEST;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->getMethod() == 'POST';
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->getMethod() == 'GET';
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $_FILES;
    }

    /**
     * @return mixed
     */
    public function getRequestJsonBody()
    {
        $data = file_get_contents('php://input');
        return json_decode($data, true);
    }
}

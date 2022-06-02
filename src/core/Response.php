<?php

namespace Khanguyennfq\CarForRent\core;

class Response
{
    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_BAD_REQUEST = 400;
    protected ?string $template = null;
    protected int $statusCode;
    protected ?string $redirectUrl = null;
    protected ?array $data = null;
    protected array $headers = [];

    /**
     * @param array $data
     * @param int $statusCode
     * @return $this
     */
    public function toJson(array $data, int $statusCode = self::HTTP_OK): self
    {
        $this->setStatusCode($statusCode);
        $this->setData($data);
        /*$this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);*/
        return $this;
    }

    /**
     * @param $template
     * @param array|null $data
     * @param int $statusCode
     * @return $this
     */
    public function view($template, array $data = null, int $statusCode = Response::HTTP_OK): self
    {
        $this->setTemplate($template);
        $this->setData($data);
        $this->setStatusCode($statusCode);
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return void
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }


    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string|null $template
     * @return void
     */
    public function setTemplate(?string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     * @return void
     */
    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    /**
     * @param string|null $redirectUrl
     * @return void
     */
    public function setRedirectUrl(?string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function redirect(string $url): self
    {
        $this->setRedirectUrl($url);
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
}

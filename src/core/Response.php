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
    public function toJson(array $data, int $statusCode = self::HTTP_OK): self
    {
        $this->setStatusCode($statusCode);
        $this->setData([$data]);
        $this->headers = array_merge($this->headers, [
            'Content-Type' => 'application/json'
        ]);
        return $this;
    }

    public function view($template, array $data = null, int $statusCode = Response::HTTP_OK): self
    {
        $this->setTemplate($template);
        if ($data != null) {
            $this->setData([$data]);

        } else {
            $this->setData(null);
        }
        $this->setStatusCode($statusCode);
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }


    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): void
    {
        $this->template = $template;
    }


    public function getData(): ?array
    {
        return $this->data;
    }


    public function setData(?array $data): void
    {
        $this->data = $data;
    }


    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }


    public function setRedirectUrl(?string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function redirect(string $url): self
    {
        $this->setRedirectUrl($url);
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }
}

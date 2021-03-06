<?php

namespace Khanguyennfq\CarForRent\Core;

class View
{

    /**
     * @param $response
     * @return void
     */
    public static function handle($response): bool
    {
        if ($response->getRedirectUrl() !== null) {
            static::handleRedirect($response);
            return true;
        }
        if ($response->getTemplate() !== null) {
            static::handleViewTemplate($response);
            return true;
        }
        static::ViewJson($response);
        exit();
    }

    /**
     * @param Response $response
     * @return void
     */
    public static function viewJson(Response $response)
    {
        $data = $response->getData();
        $statusCode = $response->getStatusCode();
        $dataResponse = json_encode($data);
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        foreach ($response->getHeaders() as $key => $value) {
            header("$key:$value;");
        }
        print_r($dataResponse);
    }

    /**
     * @param Response $response
     * @return void
     */
    public static function handleViewTemplate(Response $response): void
    {
        $template = $response->getTemplate();
        $data = $response->getData();
        http_response_code($response->getStatusCode());
        require __DIR__ . "/../View/$template.php";
    }

    /**
     * @param Response $response
     * @return void
     */
    public static function handleRedirect(Response $response): void
    {
        static::redirect($response->getRedirectUrl());
    }

    public static function redirect($url): void
    {
        header("location: $url");
    }
}

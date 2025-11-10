<?php

class Request implements RequestInterface
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    }

    public function getQuery(): array
    {
        return $_GET ?? [];
    }

    public function getBody(): array
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (is_array($data)) {
            return $data;
        }
        return $_POST ?? [];
    }

    public function getHeader(string $key, ?string $default = null): ?string
    {
        $serverKey = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        return $_SERVER[$serverKey] ?? $default;
    }
}



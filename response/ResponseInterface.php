<?php

interface ResponseInterface
{
    public function json(array $data, int $statusCode = 200): void;
    public function html(string $html, int $statusCode = 200): void;
}



<?php

interface RequestInterface
{
    public function getMethod(): string;
    public function getPath(): string;
    public function getQuery(): array;
    public function getBody(): array;
    public function getHeader(string $key, ?string $default = null): ?string;
}



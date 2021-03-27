<?php

declare(strict_types=1);

namespace Opdavies\JsonApiUrlBuilder\Service;

final class JsonApiUrlBuilder
{
    private $baseUrl;

    public static function create(string $baseUrl): self
    {
        return (new self())->setBaseUrl($baseUrl);
    }

    public function getUrl(): string
    {
        return $this->baseUrl;
    }

    private function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }
}

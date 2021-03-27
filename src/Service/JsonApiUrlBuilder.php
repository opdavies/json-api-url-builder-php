<?php

declare(strict_types=1);

namespace Opdavies\JsonApiUrlBuilder\Service;

use Webmozart\Assert\Assert;

final class JsonApiUrlBuilder
{
    private $baseUrl;

    public static function create(string $baseUrl): self
    {
        Assert::notEmpty($baseUrl, 'The base URL cannot be blank.');
        Assert::true(
            (bool) filter_var($baseUrl, FILTER_VALIDATE_URL),
            'The URL must be in a valid format.'
        );

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

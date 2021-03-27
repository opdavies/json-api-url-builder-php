<?php

declare(strict_types=1);

namespace Opdavies\JsonApiUrlBuilder\Tests\Service;

use Opdavies\JsonApiUrlBuilder\Service\JsonApiUrlBuilder;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class JsonApiUrlBuilderTest extends TestCase
{
    /**
     * @dataProvider baseUrlProvider
     * @group base-url
     * @group base-url-is-returned
     * @group base-url-is-set
     */
    public function testReturnsTheBaseUrl(string $baseUrl): void
    {
        $result = JsonApiUrlBuilder::create($baseUrl)->getUrl();

        self::assertSame($baseUrl, $result);
    }

    public function testAnInvalidUrlThrowsAnInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectDeprecationMessage('The base URL cannot be blank.');

        JsonApiUrlBuilder::create('');
    }

    public function validBaseUrlProvider(): \Generator
    {
          return [
              yield 'HTTP URL' => [
                  'baseUrl' => 'http://example.com',
              ],

              yield 'HTTPS URL' => [
                  'baseUrl' => 'https://example.com',
              ],

              yield 'URL with a prefix' => [
                  'baseUrl' => 'https://example.com/jsonapi'
              ],
          ];
    }
}

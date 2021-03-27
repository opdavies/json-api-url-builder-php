<?php

declare(strict_types=1);

namespace Opdavies\JsonApiUrlBuilder\Tests\Service;

use Opdavies\JsonApiUrlBuilder\Service\JsonApiUrlBuilder;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class JsonApiUrlBuilderTest extends TestCase
{
    /**
     * @dataProvider validBaseUrlProvider
     * @group base-url
     * @group base-url-is-returned
     * @group base-url-is-set
     */
    public function testReturnsTheBaseUrl(string $baseUrl): void
    {
        $result = JsonApiUrlBuilder::create($baseUrl)->getUrl();

        self::assertSame($baseUrl, $result);
    }

    /**
     * @dataProvider invalidBaseUrlProvider
     * @group base-url
     * @group base-url-is-empty
     * @group base-url-is-invalid
     */
    public function testAnInvalidUrlThrowsAnInvalidArgumentException(
        string $baseUrl,
        string $exceptionMessage
    ): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectDeprecationMessage($exceptionMessage);

        JsonApiUrlBuilder::create($baseUrl);
    }

    public function invalidBaseUrlProvider(): \Generator
    {
        return [
            yield 'Empty URL' => [
                'url' => '',
                'message' => 'The base URL cannot be blank.',
            ],

            yield 'An incorrect URL' => [
                'url' => 'banana',
                'message' => 'The URL must be in a valid format.',
            ],
        ];
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

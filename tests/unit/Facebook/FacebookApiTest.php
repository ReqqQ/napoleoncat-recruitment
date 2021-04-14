<?php

namespace NapoleonCat\Tests\unit\Facebook;

use Codeception\Test\Unit;
use Facebook\FacebookResponse;
use NapoleonCat\Integrations\Facebook\FacebookApi;

class FacebookApiTest extends Unit
{
    private const CURRENT_PAGE_ID = 104303108447809;

    private FacebookApi $facebookApi;

    protected function _before(): void
    {
        $this->facebookApi = new FacebookApi(
            $_ENV['APP_ID_ENV_NAME'],
            $_ENV['APP_SECRET_ENV_NAME'],
            $_ENV['LONG_TIME_TOKEN']
        );
    }

    public function testGetPosts(): void
    {
        $response = $this->facebookApi->getPosts(self::CURRENT_PAGE_ID);

        $this->checkStructure($response);
    }

    public function testGetComments(): void
    {
        $response = $this->facebookApi->getPosts(self::CURRENT_PAGE_ID);

        $this->checkStructure($response);
    }

    private function checkStructure(FacebookResponse $response): void
    {
        self::assertEquals(200, $response->getHttpStatusCode());
        self::assertIsArray($response->getDecodedBody());
        self::assertNotEmpty($response->getGraphEdge()->all());
        $responseData = $response->getGraphEdge()->all()[0];
        self::assertArrayHasKey('created_time', $responseData);
        self::assertArrayHasKey('message', $responseData);
        self::assertArrayHasKey('id', $responseData);
    }
}
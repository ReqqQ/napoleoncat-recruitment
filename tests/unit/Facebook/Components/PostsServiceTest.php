<?php

namespace NapoleonCat\Tests\unit\Facebook\Components;

use Codeception\Test\Unit;
use DateTime;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use NapoleonCat\Integrations\Facebook\FacebookApi;
use NapoleonCat\Integrations\Facebook\FacebookApiInterface;
use NapoleonCat\Integrations\Facebook\Posts\PostsService;

class PostsServiceTest extends Unit
{
    private const CURRENT_PAGE_ID = 104303108447809;
    private const EXAMPLE_DATA = [
        [
            "created_time" => "2021-04-13T07:41:17+00:00",
            "message" => "custom post",
            "id" => "104303108447809_105515584993228"
        ]
    ];
    private FacebookResponse $facebookDataResponse;
    private FacebookApiInterface $facebookApiMock;
    private FacebookRequest $facebookRequest;

    protected function _before(): void
    {
        $this->facebookDataResponse = $this->getDataFromApi();
        $this->facebookApiMock = $this->createMock(FacebookApiInterface::class);
        $this->facebookRequest = $this->createMock(FacebookRequest::class);
    }

    public function testApiResponseIsProper(): void
    {
        self::assertEquals(200, $this->facebookDataResponse->getHttpStatusCode());
    }

    public function testGetFacebookPosts(): void
    {
        $postsService = $this->getPostService($this->getJsonData(self::EXAMPLE_DATA));
        $data = $postsService->getFacebookPosts(self::CURRENT_PAGE_ID);
        $feedPost = $data->first();

        self::assertEquals(1, $data->count());
        self::assertEquals(self::EXAMPLE_DATA[0]['id'], $feedPost->getItemId());
        self::assertEquals(self::EXAMPLE_DATA[0]['message'], $feedPost->getData());
        self::assertEquals(self::EXAMPLE_DATA[0]['created_time'], date(DateTime::ATOM, $feedPost->getCreatedAt()));
    }

    public function testEmptyFacebookPosts(): void
    {
        $postsService = $this->getPostService($this->getJsonData([]));
        $data = $postsService->getFacebookPosts(self::CURRENT_PAGE_ID);

        self::assertEquals(0, $data->count());
    }

    private function getPostService(string $bodyData): PostsService
    {
        $facebookResponse = new FacebookResponse($this->facebookRequest, $bodyData);
        $this->facebookApiMock
            ->method('getPosts')
            ->willReturn($facebookResponse);

        return new PostsService($this->facebookApiMock);
    }


    private function getDataFromApi(): FacebookResponse
    {
        $facebookApi = new FacebookApi(
            $_ENV['APP_ID_ENV_NAME'],
            $_ENV['APP_SECRET_ENV_NAME'],
            $_ENV['LONG_TIME_TOKEN']
        );

        return $facebookApi->getPosts(self::CURRENT_PAGE_ID);
    }

    private function getJsonData(array $exampleData): string
    {
        return json_encode(
            [
                'data' => $exampleData
            ],
            JSON_THROW_ON_ERROR
        );
    }
}
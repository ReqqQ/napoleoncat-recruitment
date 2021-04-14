<?php

namespace NapoleonCat\Tests\unit\Facebook\Components;

use Codeception\Test\Unit;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use NapoleonCat\Integrations\Facebook\Comments\CommentService;
use NapoleonCat\Integrations\Facebook\FacebookApi;
use NapoleonCat\Integrations\Facebook\FacebookApiInterface;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\InboxItemSimpleFactory;

class CommentsServiceTest extends Unit
{
    private const CURRENT_COMMENT_ID = '104303108447809_105515584993228';
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

    public function testGetFacebookComments(): void
    {
        $commentsService = $this->getCommentsService($this->getJsonData(self::EXAMPLE_DATA));

        $data = $commentsService->getFacebookComments($this->getCollection());
        $feedPost = $data->first();

        self::assertEquals(1, $feedPost->getItemId());
        self::assertEquals(5, $feedPost->getItemParent());
        self::assertEquals(5, $feedPost->getPageSocialId());
        self::assertEquals(0, $feedPost->getItemType());
        self::assertCount(1, $feedPost->getChild());
        self::assertEquals('104303108447809_105515584993228', $feedPost->getChild()->first()->getItemId());
        self::assertEquals(1, $feedPost->getChild()->first()->getItemParent());
        self::assertEquals(1, $feedPost->getChild()->first()->getPageSocialId());
        self::assertEquals(1, $feedPost->getChild()->first()->getItemType());
    }


    private function getCommentsService(string $bodyData): CommentService
    {
        $facebookResponse = new FacebookResponse($this->facebookRequest, $bodyData);
        $this->facebookApiMock
            ->method('getComments')
            ->willReturnOnConsecutiveCalls(
                $facebookResponse,
                new FacebookResponse($this->facebookRequest, $this->getJsonData([]))
            );

        return new CommentService($this->facebookApiMock);
    }

    private function getDataFromApi(): FacebookResponse
    {
        $facebookApi = new FacebookApi(
            $_ENV['APP_ID_ENV_NAME'],
            $_ENV['APP_SECRET_ENV_NAME'],
            $_ENV['LONG_TIME_TOKEN']
        );

        return $facebookApi->getComments(self::CURRENT_COMMENT_ID);
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

    private function getCollection(): InboxItemCollection
    {
        $posts = new InboxItemCollection();
        $posts->add(
            InboxItemSimpleFactory::instance(
                [
                    'item_id' => 1,
                    'page_social_id' => 5,
                    'item_type' => 0,
                    'data' => '',
                    'created_at' => 123213,
                    'item_parent' => 5,
                ]
            )
        );

        return $posts;
    }
}
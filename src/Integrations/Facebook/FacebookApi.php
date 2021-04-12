<?php

namespace NapoleonCat\Integrations\Facebook;

use Facebook\Facebook;
use Facebook\FacebookResponse;

class FacebookApi implements FacebookApiInterface
{
    private int $appId;
    private string $appSecret;
    private string $appToken;
    private Facebook $facebookApi;

    public function __construct(int $appId, string $appSecret, string $appToken)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->appToken = $appToken;
        $this->facebookApi = $this->facebookApiInstance();
    }

    public function getPosts(int $facebookPageId): FacebookResponse
    {
        return $this->facebookApi->get("/$facebookPageId/feed", $this->appToken);
    }

    public function getComments(string $facebookPostId): FacebookResponse
    {
        return $this->facebookApi->get("/$facebookPostId/comments", $this->appToken);
    }

    private function facebookApiInstance(): Facebook
    {
        return new Facebook(
            [
                'app_id' => $this->appId,
                'app_secret' => $this->appSecret
            ]
        );
    }
}
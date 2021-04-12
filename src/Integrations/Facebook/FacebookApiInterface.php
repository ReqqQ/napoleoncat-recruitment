<?php

namespace NapoleonCat\Integrations\Facebook;

use Facebook\FacebookResponse;

interface FacebookApiInterface
{
    public function getPosts(int $facebookPageId): FacebookResponse;

    public function getComments(string $facebookPostId): FacebookResponse;
}
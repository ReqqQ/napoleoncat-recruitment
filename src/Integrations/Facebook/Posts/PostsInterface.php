<?php

namespace NapoleonCat\Integrations\Facebook\Posts;

use NapoleonCat\Model\InboxItemCollection;

interface PostsInterface
{
    public function getFacebookPosts(string $pageId): InboxItemCollection;
}
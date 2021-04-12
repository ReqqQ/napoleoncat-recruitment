<?php

namespace NapoleonCat\Integrations\Facebook\Posts;

use NapoleonCat\Integrations\Facebook\Facebook;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\ItemType;

class PostsService extends Facebook implements PostsInterface
{
    public function getFacebookPosts(string $pageId): InboxItemCollection
    {
        $posts = $this->facebookApi->getPosts($pageId)->getGraphEdge()->all();

        return $this->createInboxItemCollection($posts, $pageId, ItemType::ITEM_TYPE_POST);
    }
}
<?php

namespace NapoleonCat\Integrations\Facebook;

use NapoleonCat\Integrations\Facebook\Comments\CommentInterface;
use NapoleonCat\Integrations\Facebook\Posts\PostsInterface;
use NapoleonCat\Model\InboxItemCollection;

class FacebookService implements FacebookInterface
{
    private PostsInterface $facebookPostService;
    private CommentInterface $facebookCommentService;

    public function __construct(PostsInterface $facebookPostService, CommentInterface $facebookCommentService)
    {
        $this->facebookPostService = $facebookPostService;
        $this->facebookCommentService = $facebookCommentService;
    }

    public function getFeedFromPage(string $pageId): InboxItemCollection
    {
        $posts = $this->facebookPostService->getFacebookPosts($pageId);

        return $this->facebookCommentService->getFacebookComments($posts);
    }
}
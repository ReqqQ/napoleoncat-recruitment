<?php

namespace NapoleonCat\Integrations\Facebook\Comments;

use NapoleonCat\Model\InboxItemCollection;

interface CommentInterface
{
    public function getFacebookComments(InboxItemCollection $posts): InboxItemCollection;
}
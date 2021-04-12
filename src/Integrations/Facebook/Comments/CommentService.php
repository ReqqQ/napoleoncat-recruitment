<?php

namespace NapoleonCat\Integrations\Facebook\Comments;

use NapoleonCat\Integrations\Facebook\Facebook;
use NapoleonCat\Model\InboxItem;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\ItemType;

class CommentService extends Facebook implements CommentInterface
{
    private function hasSubcomment(array $comment): bool
    {
        return !empty($comment);
    }

    private function getComments(InboxItem $item, int $itemType): InboxItem
    {
        $comments = $this->getFacebookCommentsFromPost($item->getItemId());
        $collection = $this->createInboxItemCollection($comments, $item->getItemId(), $itemType);

        foreach ($collection as $comment) {
            $this->commentsHasSubcomments($comment);
        }

        $item->setChild($collection);

        return $item;
    }

    private function commentsHasSubcomments(InboxItem $comment): void
    {
        $subcoments = $this->getFacebookCommentsFromPost($comment->getItemId());

        if ($this->hasSubcomment($subcoments)) {
            $this->getComments($comment, ItemType::ITEM_TYPE_SUB_COMMENT);
        }
    }

    public function getFacebookComments(InboxItemCollection $posts): InboxItemCollection
    {
        $collection = new InboxItemCollection();
        foreach ($posts as $post) {
            $collection->add($this->getComments($post, ItemType::ITEM_TYPE_COMMENT));
        }

        return $collection;
    }

    private function getFacebookCommentsFromPost(string $postId): array
    {
        return $this->facebookApi->getComments($postId)->getGraphEdge()->all();
    }

}
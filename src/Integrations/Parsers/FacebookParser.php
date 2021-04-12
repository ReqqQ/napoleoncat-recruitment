<?php

namespace NapoleonCat\Integrations\Parsers;

use Facebook\GraphNodes\GraphNode;

class FacebookParser
{
    public static function parse(GraphNode $data, string $pageId, int $itemType): array
    {
        return [
            "item_id" => $data['id'],
            "page_social_id" => $pageId,
            "item_parent" => $pageId,
            "item_type" => $itemType,
            "data" => $data['message'],
            "created_at" => $data['created_time']->getTimestamp()
        ];
    }
}
<?php

namespace NapoleonCat\Model;

class InboxItemSimpleFactory
{
    public static function instance(array $parsedData): InboxItem
    {
        return new InboxItem(
            $parsedData['item_id'],
            $parsedData['page_social_id'],
            $parsedData['item_type'],
            $parsedData['data'],
            $parsedData['created_at'],
            $parsedData['item_parent'],
        );
    }
}
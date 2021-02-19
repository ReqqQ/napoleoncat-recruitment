<?php

namespace NapoleonCat\Model;

use NapoleonCat\Utils\TypedCollection;

/**
 * Class InboxItemCollection
 * @package NapoleonCat\Model
 */
class InboxItemCollection extends TypedCollection
{
    public function __construct()
    {
        $this->setType(InboxItem::class);
    }
}
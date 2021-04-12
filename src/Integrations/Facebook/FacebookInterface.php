<?php

namespace NapoleonCat\Integrations\Facebook;

use NapoleonCat\Model\InboxItemCollection;

interface FacebookInterface
{
    public function getFeedFromPage(string $pageId): InboxItemCollection;
}
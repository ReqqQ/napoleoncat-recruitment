<?php

namespace NapoleonCat\Services;

use NapoleonCat\Model\InboxItemCollection;

/**
 * Class ScanPageFeed
 * @package NapoleonCat\Services
 */
class PageScanner implements PageScannerInterface
{

    public function __construct()
    {
    }

    public function scan(string $pageId, string $pageAT): InboxItemCollection
    {

    }
}
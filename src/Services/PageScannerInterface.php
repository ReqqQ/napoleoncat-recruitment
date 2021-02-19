<?php

declare(strict_types=1);
namespace NapoleonCat\Services;

use NapoleonCat\Model\InboxItemCollection;

interface PageScannerInterface
{
    public function __construct();

    /**
     * @param string $pageId
     * @param string $pageAT
     * @return InboxItemCollection
     */
    public function scan(string $pageId, string $pageAT): InboxItemCollection;
}
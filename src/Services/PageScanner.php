<?php

namespace NapoleonCat\Services;

use NapoleonCat\Integrations\Facebook\FacebookInterface;
use NapoleonCat\Integrations\Facebook\FacebookService;
use NapoleonCat\Model\InboxItemCollection;

/**
 * Class ScanPageFeed
 * @package NapoleonCat\Services
 */
class PageScanner implements PageScannerInterface
{
    private FacebookService $facebookService;

    public function __construct(FacebookInterface $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function scan(string $pageId): InboxItemCollection
    {
        return $this->facebookService->getFeedFromPage($pageId);
    }
}
<?php

declare(strict_types=1);

namespace NapoleonCat\Services;

use NapoleonCat\Integrations\Facebook\FacebookInterface;
use NapoleonCat\Model\InboxItemCollection;

interface PageScannerInterface
{
    public function __construct(FacebookInterface $facebookService);

    /**
     * @param string $pageId
     * @return InboxItemCollection
     */
    public function scan(string $pageId): InboxItemCollection;
}
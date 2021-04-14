<?php

namespace NapoleonCat\Integrations\Facebook;

use Facebook\GraphNodes\GraphNode;
use NapoleonCat\Integrations\Parsers\FacebookParser;
use NapoleonCat\Model\InboxItem;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\InboxItemSimpleFactory;

abstract class Facebook
{
    protected FacebookApiInterface $facebookApi;

    public function __construct(FacebookApiInterface $facebookApi)
    {
        $this->facebookApi = $facebookApi;
    }

    protected function createInboxItemCollection(array $responseData, string $pageId, int $itemType): InboxItemCollection
    {
        $collection = new InboxItemCollection();

        foreach ($responseData as $feed) {
            $collection->add($this->createInboxItem($feed, $pageId, $itemType));
        }

        return $collection;
    }

    private function createInboxItem(GraphNode $feed, string $pageId, int $itemType): InboxItem
    {
        $parsedData = FacebookParser::parse($feed, $pageId, $itemType);

        return InboxItemSimpleFactory::instance($parsedData);
    }
}
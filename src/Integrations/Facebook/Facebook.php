<?php

namespace NapoleonCat\Integrations\Facebook;

use NapoleonCat\Integrations\Parsers\FacebookParser;
use NapoleonCat\Model\InboxItemCollection;
use NapoleonCat\Model\InboxItemSimpleFactory;

abstract class Facebook
{
    protected FacebookApiInterface $facebookApi;

    public function __construct(FacebookApiInterface $facebookApi)
    {
        $this->facebookApi = $facebookApi;
    }

    protected function createInboxItemCollection(array $posts, string $pageId, int $itemType): InboxItemCollection
    {
        $collection = new InboxItemCollection();

        foreach ($posts as $post) {
            $parsedData = FacebookParser::parse($post, $pageId, $itemType);
            $collection->add(InboxItemSimpleFactory::instance($parsedData));
        }

        return $collection;
    }
}
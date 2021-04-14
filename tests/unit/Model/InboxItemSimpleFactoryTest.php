<?php

namespace NapoleonCat\Tests\unit\Model;

use Codeception\Test\Unit;
use NapoleonCat\Model\InboxItem;
use NapoleonCat\Model\InboxItemSimpleFactory;
use TypeError;

class InboxItemSimpleFactoryTest extends Unit
{
    private InboxItem $inboxItem;
    private array $testedData;

    protected function _before(): void
    {
        $this->testedData = [
            'item_id' => 1,
            'page_social_id' => 2,
            'item_type' => 3,
            'data' => '',
            'created_at' => 756546456,
            'item_parent' => 5,
        ];
        $this->inboxItem = InboxItemSimpleFactory::instance($this->testedData);
    }

    public function testCreateProperInboxItem(): void
    {
        self::assertEquals(InboxItem::class, get_class($this->inboxItem));
        self::assertEquals($this->testedData['item_id'], $this->inboxItem->getItemId());
        self::assertEquals($this->testedData['page_social_id'], $this->inboxItem->getPageSocialId());
        self::assertEquals($this->testedData['item_type'], $this->inboxItem->getItemType());
        self::assertEquals($this->testedData['data'], $this->inboxItem->getData());
        self::assertEquals($this->testedData['created_at'], $this->inboxItem->getCreatedAt());
        self::assertEquals($this->testedData['item_parent'], $this->inboxItem->getItemParent());
    }

    public function testCreateWrongInboxItem(): void
    {
        $this->testedData['created_at'] = '2020-04-20';
        $this->expectException(TypeError::class);
        $this->inboxItem = InboxItemSimpleFactory::instance($this->testedData);
    }
}
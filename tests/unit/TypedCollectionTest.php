<?php

namespace NapoleonCat\Tests\unit;

use Codeception\Test\Unit;
use NapoleonCat\Model\InboxItem;
use NapoleonCat\Utils\TypedCollection;
use PHPUnit\Framework\MockObject\MockObject;
use UnexpectedValueException;

class TypedCollectionTest extends Unit
{
    /**
     * @var TypedCollection|MockObject
     */
    private TypedCollection|MockObject $testCollection;

    protected function _before(): void
    {
        parent::_before();
        $this->testCollection = new class extends TypedCollection {
            public function __construct()
            {
            }
        };
    }

    /**
     * Test type getter and setter.
     */
    public function testType(): void
    {
        $type = InboxItem::class;
        $this->testCollection->setType($type);
        self::assertNotEmpty($this->testCollection->getType());
        self::assertEquals($type, $this->testCollection->getType());
    }

    /**
     * Test container getter and setter.
     */
    public function testContainerAndMethods(): void
    {
        $container = ['a', 'b', 'c', 'd'];
        $this->testCollection->setContainer($container);
        self::assertNotEmpty($this->testCollection->getContainer());
        self::assertEquals($container, $this->testCollection->getContainer());
    }

    /**
     * Test for exception.
     */
    public function testExceptionForWrongClass(): void
    {
        $this->testCollection->setType(InboxItem::class);
        $this->expectException(UnexpectedValueException::class);
        $this->testCollection->offsetSet('1', [1, 2, 3]);
    }

    /**
     * Offset methods test.
     */
    public function testMethodsForOffset(): void
    {
        $this->testCollection->setType(InboxItem::class);

        $offsetName = 'firstUser';
        $firstUser = $this->exampleInboxItemClass();

        $offsetSecond = 'secondUser';
        $secondUser = $this->exampleInboxItemClass();

        self::assertFalse($this->testCollection->offsetExists($offsetName));
        $this->testCollection->offsetSet($offsetName, $firstUser);
        self::assertTrue($this->testCollection->offsetExists($offsetName));
        self::assertEquals($firstUser, $this->testCollection->offsetGet($offsetName));

        $this->testCollection->add($secondUser);
        self::assertEquals(2, $this->testCollection->count());

        self::assertEquals($firstUser, $this->testCollection->first());

        $this->testCollection->offsetUnset($offsetName);
        self::assertFalse($this->testCollection->offsetExists($offsetName));

        self::assertEquals(1, $this->testCollection->count());
    }

    private function exampleInboxItemClass(): InboxItem
    {
        return new InboxItem(
            1,
            3,
            1,
            'empty',
            '2321',
            '123'
        );
    }
}
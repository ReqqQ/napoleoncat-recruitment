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
    private $testCollection;

    protected function _before()
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
    public function testType()
    {
        $type = InboxItem::class;
        $this->testCollection->setType($type);
        $this->assertNotEmpty($this->testCollection->getType());
        $this->assertEquals($type, $this->testCollection->getType());
    }

    /**
     * Test container getter and setter.
     */
    public function testContainerAndMethods()
    {
        $container = ['a', 'b', 'c', 'd'];
        $this->testCollection->setContainer($container);
        $this->assertNotEmpty($this->testCollection->getContainer());
        $this->assertEquals($container, $this->testCollection->getContainer());
    }

    /**
     * Test for exception.
     */
    public function testExceptionForWrongClass()
    {
        $this->testCollection->setType(InboxItem::class);
        $this->expectException(UnexpectedValueException::class);
        $this->testCollection->offsetSet('1', [1, 2, 3]);
    }

    /**
     * Offset methods test.
     */
    public function testMethodsForOffset()
    {
        $this->testCollection->setType(InboxItem::class);

        $offsetName = 'firstUser';
        $firstUser = new InboxItem();

        $offsetSecond = 'secondUser';
        $secondUser = new InboxItem();

        $this->assertFalse($this->testCollection->offsetExists($offsetName));
        $this->testCollection->offsetSet($offsetName, $firstUser);
        $this->assertTrue($this->testCollection->offsetExists($offsetName));
        $this->assertEquals($firstUser, $this->testCollection->offsetGet($offsetName));

        $this->testCollection->add($secondUser);
        $this->assertEquals(2, $this->testCollection->count());

        $this->assertEquals($firstUser, $this->testCollection->first());

        $this->testCollection->offsetUnset($offsetName);
        $this->assertFalse($this->testCollection->offsetExists($offsetName));

        $this->assertEquals(1, $this->testCollection->count());
    }
}
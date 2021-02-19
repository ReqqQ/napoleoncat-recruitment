<?php

declare(strict_types=1);
namespace NapoleonCat\Utils;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use UnexpectedValueException;

/**
 * Class TypedCollection
 * @package Mohawk\Microblog\Utils
 */
abstract class TypedCollection implements ArrayAccess, IteratorAggregate, Countable
{
    protected $type;

    protected array $container = [];

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return TypedCollection
     */
    public function setType($type): TypedCollection
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getContainer(): array
    {
        return $this->container;
    }

    /**
     * @param array $container
     * @return TypedCollection
     */
    public function setContainer(array $container): TypedCollection
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Set $type
     * TypedCollection constructor.
     */
    abstract public function __construct();

    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * @param string $offset
     * @return TypedCollection
     */
    public function offsetUnset($offset): TypedCollection
    {
        unset($this->container[$offset]);
        return $this;
    }

    /**
     * @param string $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset];
    }

    /**
     * @param string $offset
     * @param mixed $value
     * @return TypedCollection
     */
    public function offsetSet(mixed $offset, mixed $value): TypedCollection
    {
        if (!is_a($value, $this->type)) {
            throw new UnexpectedValueException('Wrong type.');
        }
        if (null === $offset) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }

        return $this;
    }

    /**
     * @param mixed $element
     * @return TypedCollection
     */
    public function add(mixed $element): TypedCollection
    {
        $this->offsetSet(null, $element);
        return $this;
    }

    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->container);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->container);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->getContainer());
    }
}
<?php

declare(strict_types=1);
namespace NapoleonCat\Infrastructure;
/**
 * Class QueueRepositoryInterface
 */
interface QueueRepositoryInterface
{
    public function push(mixed $data);
}
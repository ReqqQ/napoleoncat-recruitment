<?php

namespace NapoleonCat\Services;

/**
 * Class ATProviderInterface
 * @package NapoleonCat\Services
 */
interface ATProviderInterface
{
    /**
     * @param string $pageSocialId
     * @return string
     */
    public function getPageAccessToken(string $pageSocialId): string;
}
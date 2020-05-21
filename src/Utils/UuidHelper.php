<?php

namespace VK\DoctrineManagerBundle\Utils;

use Ramsey\Uuid\Uuid;

/**
 * Class UuidHelper
 */
class UuidHelper
{
    /**
     * @param string $uuid
     * @return string
     */
    public static function decode(string $uuid)
    {
        try {
            $id = Uuid::fromString($uuid)->getBytes();
        } catch (\InvalidArgumentException $e) {
            $id = ''; //need enable strict mode for sql
        }

        return $id;
    }

    /**
     * @param string $uuid
     * @return string
     */
    public static function hex(string $uuid)
    {
        return Uuid::fromString($uuid)->getHex();
    }
}

<?php

namespace VK\DoctrineManagerBundle\Helper;

/**
 * Class DateFormatHelper
 */
class DateFormatHelper
{
    /**
     * @param string|null|\DateTime $date
     * @param string                $format Date format string
     *
     * @return string
     */
    public static function format($date, $format = 'Y-m-d\TH:i:sP')
    {
        $result = '';
        $dateObject = null;

        if ($date instanceof \DateTime) {
            $dateObject = $date;
        } elseif (\is_numeric($date) && self::validateTimestamp($date)) {
            $dateObject = new \DateTime('@'.$date);
        } elseif (self::validateDate($date)) {
            $dateObject = new \DateTime($date);
        }

        if (null !== $dateObject) {
            $result = \str_replace(
                '+00:00',
                'Z',
                $dateObject
                    ->setTimezone(new \DateTimeZone('UTC'))
                    ->format($format)
            );
        }

        return $result;
    }


    /**
     * @param null|string $date
     * @return bool
     */
    public static function validateDate($date): bool
    {
        return $date && \date_create($date) !== false;
    }

    /**
     * @param int $timestamp
     *
     * @return bool
     */
    public static function validateTimestamp($timestamp): bool
    {
        return $timestamp
        && \strlen($timestamp) === 10
        && \date_create('@'.$timestamp) !== false;
    }
}

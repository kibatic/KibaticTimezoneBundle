<?php
namespace Kibatic\TimezoneBundle\Adjuster;

/**
 * Tools to make timezone conversions
 */
class AdjusterUtil
{
    public const EXCHANGE_FORMAT='Y-m-d\TH:i:s.uP';
    /**
     * Change the timezone of a \DateTime
     *
     * @param \DateTimeInterface $date
     * @param \DateTimeZone $timezone
     * @return \DateTime
     */
    public static function changeTimezone(
        \DateTimeInterface $date,
        \DateTimeZone $timezone
    ): \DateTime
    {
        $resultDate = \DateTime::createFromFormat(
            self::EXCHANGE_FORMAT,
            $date->format(self::EXCHANGE_FORMAT)
        );
        $resultDate->setTimezone($timezone);
        return $resultDate;
    }
}

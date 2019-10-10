<?php
namespace Kibatic\TimezoneBundle\Adjuster;

interface AdjusterInterface
{
    /**
     * returns the timezone provided by the TimezoneProvider or the default
     * timezone if the provider returns null
     */
    public function getDisplayTimezone(): \DateTimeZone;

    /**
     * returns the date as DateTimeImmutable with the timezone given by the TimezoneProvider
     */
    public function asDateTimeImmutable(\DateTimeInterface $date): \DateTimeImmutable;

    /**
     * returns the date as DateTime with the timezone given by the TimezoneProvider
     */
    public function asDateTime(\DateTimeInterface $date): \DateTime;
}

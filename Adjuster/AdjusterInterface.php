<?php
namespace Kibatic\TimezoneBundle\Adjuster;

interface AdjusterInterface
{
    /**
     * returns the timezone provided by the TimezoneProvider or the default
     * timezone if the provider returns null
     */
    public function getDisplayTimezone(): \DateTimeZone;
}

<?php
namespace Kibatic\TimezoneBundle\Provider;

interface TimezoneProviderInterface
{
    /**
     * This method returns the timezone of the user surfing on its website.
     *
     * It can be used in several contexts
     *
     * - on a website
     * - in a command
     * - in an API
     *
     * if null is returned, the default display timezone is used
     *
     * Ex:
     * Imagine a project where the default timezone is GMT+0 for it's data.
     * Every user can set in it's preference the timezone he wants to display.
     * In this example, the TimezoneProvider has to get this timezone from
     * the preference of the user and returns it.
     *
     *
     * @return \DateTimeZone
     */
    public function getDisplayTimezone(): ?\DateTimeZone;
}

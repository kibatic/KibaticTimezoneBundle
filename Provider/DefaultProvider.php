<?php
namespace Kibatic\TimezoneBundle\Provider;

class DefaultProvider implements TimezoneProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getDisplayTimezone(): ?\DateTimeZone
    {
        return null;
    }
}

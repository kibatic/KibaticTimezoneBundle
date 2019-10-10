<?php
namespace Kibatic\TimezoneBundle\Tests\App\Service;

use Kibatic\TimezoneBundle\Provider\TimezoneProviderInterface;

class MyProvider implements TimezoneProviderInterface
{
    public function getDisplayTimezone(): ?\DateTimeZone
    {
        return new \DateTimeZone('Europe/Berlin');
    }
}

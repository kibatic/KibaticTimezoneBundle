<?php
namespace Kibatic\TimezoneBundle\Tests\Config;

use Kibatic\TimezoneBundle\Adjuster\Adjuster;
use Kibatic\TimezoneBundle\Tests\App\AppKernelFull;
use Kibatic\TimezoneBundle\Tests\App\AppKernelMinimum;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfigTest extends WebTestCase
{
    public function setUp()
    {
        parent::setUp();
        ini_set("date.timezone", 'GMT+0');
    }

    public function testParsingDefaultTimezoneConfig()
    {
        $client = new AppKernelMinimum('test', true);
        $client->boot();
        /** @var Adjuster $adjuster */
        $adjuster = $client->getContainer()->get('kibatic_timezone.adjuster');
        $this->assertEquals('Europe/Paris', $adjuster->getDisplayTimezone()->getName());
    }
    public function testParsingFullConfig()
    {
        $client = new AppKernelFull('test', true);
        $client->boot();
        /** @var Adjuster $adjuster */
        $adjuster = $client->getContainer()->get('kibatic_timezone.adjuster');
        $this->assertEquals('Europe/Berlin', $adjuster->getDisplayTimezone()->getName());
    }
}

<?php
namespace Kibatic\TimezoneBundle\Tests\Config;

use Kibatic\TimezoneBundle\Adjuster\Adjuster;
use Kibatic\TimezoneBundle\Tests\App\AppKernelDefaultTimezone;
use Kibatic\TimezoneBundle\Tests\App\AppKernelEmpty;
use Kibatic\TimezoneBundle\Tests\App\AppKernelFull;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfigTest extends WebTestCase
{
    /*
    public function testParsingEmptyConfit()
    {
        $client = self::createClient();
        $adjuster = $client->getContainer()->get('kibatic_timezone.adjuster');
        $this->assertEquals('Europe/Paris', $adjuster->getDisplayTimezone()->getName());
    }
*/
    public function testParsingEmptyConfig()
    {
        $client = new AppKernelEmpty('test', true);
        $client->boot();
        /** @var Adjuster $adjuster */
        $adjuster = $client->getContainer()->get('kibatic_timezone.adjuster');
        $this->assertEquals('Europe/Paris', $adjuster->getDisplayTimezone()->getName());
    }
    public function testParsingDefaultTimezoneConfig()
    {
        $client = new AppKernelDefaultTimezone('test', true);
        $client->boot();
        /** @var Adjuster $adjuster */
        $adjuster = $client->getContainer()->get('kibatic_timezone.adjuster');
        $this->assertEquals('+01:00', $adjuster->getDisplayTimezone()->getName());
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

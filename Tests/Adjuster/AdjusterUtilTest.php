<?php
namespace Kibatic\TimezoneBundle\Tests\Adjuster;

use Kibatic\TimezoneBundle\Adjuster\Adjuster;
use Kibatic\TimezoneBundle\Adjuster\AdjusterUtil;
use Kibatic\TimezoneBundle\Provider\DefaultProvider;
use PHPUnit\Framework\TestCase;

class AdjusterUtilTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        ini_set("date.timezone", 'GMT+0');
    }

    public function testWithDefaultTimezone()
    {
        $date = new \DateTime('2019-10-03T15:28:06');
        $dateModified = AdjusterUtil::changeTimezone($date, new \DateTimeZone('Europe/Paris'));

        $this->assertEquals(
            '2019-10-03T17:28:06+02:00',
            $dateModified->format(\DateTime::ATOM)
        );
        $this->assertTrue($dateModified instanceof \DateTime);
    }

    public function testWithCustomTimezone()
    {
        $date = new \DateTime('2019-10-03T15:28:06+01:00');
        $dateModified = AdjusterUtil::changeTimezone($date, new \DateTimeZone('Europe/Paris'));

        $this->assertEquals(
            '2019-10-03T16:28:06+02:00',
            $dateModified->format(\DateTime::ATOM)
        );
        $this->assertTrue($dateModified instanceof \DateTime);
    }
    public function testWithMicroTime()
    {
        $date = new \DateTime('2019-10-03T15:28:06.256+02:00');
        $dateModified = AdjusterUtil::changeTimezone($date, new \DateTimeZone('GMT+0'));

        $this->assertEquals(
            '2019-10-03T13:28:06.256000+00:00',
            $dateModified->format(AdjusterUtil::EXCHANGE_FORMAT)
        );
        $this->assertTrue($dateModified instanceof \DateTime);
    }
}

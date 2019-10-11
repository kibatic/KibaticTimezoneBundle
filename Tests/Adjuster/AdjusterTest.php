<?php
namespace Kibatic\TimezoneBundle\Tests\Adjuster;

use Kibatic\TimezoneBundle\Adjuster\Adjuster;
use Kibatic\TimezoneBundle\Provider\DefaultProvider;
use PHPUnit\Framework\TestCase;

class AdjusterTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        ini_set("date.timezone", 'GMT+0');
    }

    public function testGetDisplayTimezone()
    {
        $adj = new Adjuster(
            'Europe/Paris',
            new DefaultProvider()
        );
        $this->assertEquals('Europe/Paris', $adj->getDisplayTimezone()->getName());
    }

    public function testAsDateTime()
    {
        $adj = new Adjuster(
            'Europe/Paris',
            new DefaultProvider()
        );
        $date = new \DateTime('2019-10-03T15:28:06');
        $dateModified = $adj->asDateTime($date);

        $this->assertEquals(
            '2019-10-03T17:28:06+02:00',
            $dateModified->format(\DateTime::ATOM)
        );
        $this->assertTrue($dateModified instanceof \DateTime);

        $dateImmutable = $adj->asDateTimeImmutable($date);
        $this->assertEquals(
            '2019-10-03T17:28:06+02:00',
            $dateImmutable->format(\DateTime::ATOM)
        );
        $this->assertTrue($dateImmutable instanceof \DateTimeImmutable);
    }
}

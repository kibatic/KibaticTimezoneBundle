<?php
namespace Kibatic\TimezoneBundle\Tests\Config;

use Kibatic\TimezoneBundle\Tests\App\AppKernelMinimum;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Twig\Environment;

class TwigExtensionTest extends WebTestCase
{
    public function setUp()
    {
        parent::setUp();
        ini_set("date.timezone", 'GMT+0');
    }

    public function testTwigExtension()
    {
        $client = new AppKernelMinimum('test', true);
        $client->boot();
        /** @var Environment $twig */
        $twig = $client->getContainer()->get('twig');
        $rendered = $twig->render(
            'test.html.twig',
            ['date' => new \DateTime('2019-10-03T15:28:06')]
        );
        $this->assertEquals(
            "2019-10-03 17:28:06 +0200\nOctober 3, 2019 17:28\n",
            $rendered
        );
    }
}

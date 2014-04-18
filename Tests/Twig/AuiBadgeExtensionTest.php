<?php

namespace mvhirsch\AuiIntegrationBundle\Tests\Twig;

use mvhirsch\AuiIntegrationBundle\Twig\AuiBadgeExtension;
use Symfony\Component\DomCrawler\Crawler;

class AuiBadgeExtensionText extends \PHPUnit_Framework_TestCase
{
    /**
     * System Under Test
     *
     * @var AuiBadgeExtension
     */
    protected $SUT = null;

    protected function setUp()
    {
        $this->SUT = new AuiBadgeExtension();
    }

    /**
     * @test
     */
    public function willReturnOnlySpanNode()
    {
        $crawler = new Crawler($this->SUT->generateBadge(3));
        $this->assertCount(1, $crawler->filterXPath('//body')->children(), 'Contains only one element');
    }

    /**
     * @test
     * @dataProvider badgeProvider
     */
    public function generateBadge($input, $contains)
    {
        $crawler = new Crawler($this->SUT->generateBadge($input));
        $this->assertContains($contains, $crawler->filterXPath('//span')->text());
    }

    /**
     * @test
     */
    public function registerTwigFunction()
    {
        $functions = $this->SUT->getFunctions();
        foreach ($functions as $function) {
            $this->assertInstanceOf('\Twig_SimpleFunction', $function);
        }

        $this->assertGreaterThan(0, $functions);
        $this->assertSame('aui_badge', $functions[0]->getName());
    }

    /**
     * @return array
     */
    public function badgeProvider()
    {
        return array(
            array(3, '3'),
            array(-3, '-3'),
            array('aaa', 'aaa'),
            array('.5', '.5'),
        );
    }
}

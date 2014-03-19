<?php

namespace mvhirsch\Bundle\AuiBundle\Tests\Twig;

use mvhirsch\Bundle\AuiBundle\Twig\AuiBadgeExtension;
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

        $functions = $this->SUT->getFunctions();
        foreach ($functions as $function) {
            $this->assertInstanceOf('\Twig_SimpleFunction', $function);
        }
    }

    /**
     * @test
     */
    public function willReturnHtml()
    {
        $this->markTestIncomplete('How did I solve that?');
        $badge = $this->SUT->generateBadge(3);
        $crawler = new Crawler($badge);

        $this->assertCount(1, $crawler->filter(''), 'Contains only one element');
        $this->assertCount(1, $crawler->filter('span.aui-badge'), 'Contains span.aui-badge');
    }

    /**
     * @test
     * @dataProvider badgeProvider
     */
    public function generateBadge($input, $contains)
    {
        $badge = $this->SUT->generateBadge($input);
        $crawler = new Crawler($badge);

        $this->assertContains($contains, $crawler->filterXPath('//span')->text());
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
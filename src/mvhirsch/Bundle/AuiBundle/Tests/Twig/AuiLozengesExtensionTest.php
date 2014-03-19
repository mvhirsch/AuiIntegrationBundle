<?php

namespace mvhirsch\Bundle\AuiBundle\Tests\Twig;

use mvhirsch\Bundle\AuiBundle\Twig\AuiLozengesExtension;
use Symfony\Component\DomCrawler\Crawler;

class AuiLozengesExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * System Under Test
     * @var AuiLozengesExtension
     */
    protected $SUT = null;

    protected function setUp()
    {
        $this->SUT = new AuiLozengesExtension();
    }

    /**
     * @test
     *
     * @dataProvider lozengeProvider
     */
    public function generateLozenge($text, $type, $xPath, $html)
    {
        $this->markTestIncomplete('WIP');
        $lozenge = $this->SUT->generateLozenge($text, $type);
        $crawler = new Crawler($lozenge);

        $this->assertSame($html, $crawler->filterXPath($xPath)->text());
//        $this->assertSame('')
    }

    /**
     * @test
     */
    public function willReturnHtml()
    {
        $this->markTestIncomplete('how to solve HTML/NODE?');
        $lozenge = $this->SUT->generateLozenge('message');
        $crawler = new Crawler($lozenge);
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
        $this->assertSame('aui_lozenge', $functions[0]->getName());
    }

    /**
     * @return array
     */
    public function lozengeProvider()
    {
        return array(
            array('message', null, '/span', 'message'),
            array('error-message', 'error', '/span.aui-lozenge-error', 'error-message'),
            array('success-message', 'success', '/span.aui-lozenge-success', 'success-message'),
        );
    }
}
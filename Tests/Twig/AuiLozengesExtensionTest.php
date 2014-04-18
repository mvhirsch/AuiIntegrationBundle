<?php

namespace mvhirsch\AuiIntegrationBundle\Tests\Twig;

use mvhirsch\AuiIntegrationBundle\Twig\AuiLozengesExtension;
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
     */
    public function generateADefaultLozenge()
    {
        $crawler = new Crawler($this->SUT->generateLozenge('test message'));

        $this->assertSame('test message', $crawler->filter('span')->text());
        $this->assertSame('aui-lozenge', $crawler->filter('span')->attr('class'));
    }

    /**
     * @test
     *
     * @dataProvider lozengeProvider
     */
    public function generateLozengeSetsCorrectCssClass($type, $class)
    {
        $crawler = new Crawler($this->SUT->generateLozenge('test message', $type));
        $this->assertContains($class, $crawler->filter('span')->attr('class'));
    }

    /**
     * @test
     */
    public function willThrowExceptionOnInvalidType()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->SUT->generateLozenge('test message', 'invalid-type');
    }

    /**
     * @test
     *
     * @dataProvider lozengeProvider
     */
    public function generateSubtledLozenge($type, $class)
    {
        $crawler = new Crawler($this->SUT->generateLozenge('test message', $type, true));
        $this->assertContains('aui-lozenge-subtle', $crawler->filter('span')->attr('class'));
    }

    /**
     * @test
     */
    public function willReturnOnlySpanNode()
    {
        $crawler = new Crawler($this->SUT->generateLozenge('message'));
        $this->assertCount(1, $crawler->filterXPath('//body')->children());
    }

    /**
     * @test
     */
    public function registersTwigFunction()
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
            array('error', 'aui-lozenge-error'),
            array('success', 'aui-lozenge-success'),
            array('current', 'aui-lozenge-current'),
            array('complete', 'aui-lozenge-complete'),
            array('moved', 'aui-lozenge-moved'),
        );
    }
}

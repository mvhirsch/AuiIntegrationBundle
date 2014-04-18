<?php

namespace mvhirsch\AuiIntegrationBundle\Tests\Twig;

use mvhirsch\AuiIntegrationBundle\Twig\AuiMessageExtension;
use Symfony\Component\DomCrawler\Crawler;

class AuiMessageExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * System Under Test
     * @var AuiMessageExtension
     */
    protected $SUT = null;

    protected function setUp()
    {
        $this->SUT = new AuiMessageExtension();
    }

    /**
     * @test
     */
    public function willReturnValidHtml()
    {
        $crawler = new Crawler($this->SUT->generateMessage('default', 'my title', 'my message'));
        $this->assertCount(1, $crawler->filterXPath('//body')->children());
    }

    /**
     * @test
     * @depends willReturnValidHtml
     */
    public function generatesADefaultMessage()
    {
        $crawler = new Crawler($this->SUT->generateMessage('default', 'my title', 'my message'));
        $this->assertCount(2, $crawler->filter('div > p'), 'Paragraphs exists.');
        $this->assertSame('aui-message', $crawler->filter('div')->attr('class'));

        $titleParagraph = $crawler->filterXPath('//body/div/p[1]');
        $this->assertSame('title', $titleParagraph->attr('class'));
        $this->assertSame('my title', $titleParagraph->text());

        $messageParagraph = $crawler->filterXPath('//body/div/p[2]');
        $this->assertSame('my message', $messageParagraph->text());
    }

    /**
     * @test
     * @depends willReturnValidHtml
     */
    public function titleCanBeSkipped()
    {
        $crawler = new Crawler($this->SUT->generateMessage('default', null, 'my message'));
        $this->assertCount(1, $crawler->filter('div > p'), 'div contains only one paragraph.');
    }

    /**
     * @test
     * @depends willReturnValidHtml
     */
    public function generateMessageAddsIcon()
    {
        $crawler = new Crawler($this->SUT->generateMessage('error', 'error title', 'error message'));
        $span = $crawler->filterXPath('//body/div/p[1]/span');

        $this->assertCount(1, $span);
        $this->assertSame('aui-icon icon-error', $span->attr('class'));
    }

    /**
     * @test
     * @depends willReturnValidHtml
     */
    public function defaultMessageContainsIconGeneric()
    {
        $crawler = new Crawler($this->SUT->generateMessage('default', 'default title', 'a default message'));
        $span = $crawler->filterXPath('//body/div/p[1]/span');

        $this->assertCount(1, $span);
        $this->assertSame('aui-icon', $span->attr('class'));
    }

    /**
     * @test
     * @depends willReturnValidHtml
     */
    public function generateMessageSurroundsTitleWithStrong()
    {
        $crawler = new Crawler($this->SUT->generateMessage('default', 'my strong title', 'message'));
        $strong = $crawler->filterXPath('//body/div/p[1]/strong');

        $this->assertCount(1, $strong, 'Title is surrounded with <strong>');
        $this->assertSame('my strong title', $strong->text());
    }

    /**
     * @test
     */
    public function willThrowExceptionOnInvalidType()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->SUT->generateMessage('invalid-type', 'title', 'message');
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
        $this->assertSame('aui_message', $functions[0]->getName());
    }
}

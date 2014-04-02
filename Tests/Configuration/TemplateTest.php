<?php

namespace mvhirsch\Bundle\AuiBundle\Tests\Configuration;

use mvhirsch\Bundle\AuiBundle\Configuration\Template;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * System Under Test
     *
     * @var mvhirsch\Bundle\AuiBundle\Configuration\Template
     */
    protected $SUT = null;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->SUT = new Template(array());
        $this->assertInstanceOf('mvhirsch\Bundle\AuiBundle\Configuration\Template', $this->SUT);
    }

    /**
     * @test
     */
    public function getDefaultLayout()
    {
        $this->assertSame(Template::AUI_LAYOUT_DEFAULT, $this->SUT->getLayout());
    }

    /**
     * @test
     */
    public function setLayoutToHybrid()
    {
        $this->SUT->setLayout(Template::AUI_LAYOUT_HYBRID);
        $this->assertSame(Template::AUI_LAYOUT_HYBRID, $this->SUT->getLayout());
    }

    /**
     * @test
     */
    public function setLayoutAcceptsArray()
    {
        $this->SUT->setLayout(array(Template::AUI_LAYOUT_FLUID));
        $this->assertSame(Template::AUI_LAYOUT_FLUID, $this->SUT->getLayout());
    }

    /**
     * @test
     */
    public function setLayoutFailsOnInvalidLayoutName()
    {
        $this->setExpectedException('\BadMethodCallException');
        $this->SUT->setLayout('invalid');
    }

    /**
     * @test
     */
    public function setLayoutToFocusedSize()
    {
        $this->SUT->setLayout(array(Template::AUI_LAYOUT_FOCUSED, 'small'));
        $this->assertSame(Template::AUI_LAYOUT_FOCUSED, $this->SUT->getLayout());
        $this->assertSame('small', $this->SUT->getFocusedLayoutSize());
    }

    /**
     * @test
     */
    public function setLayoutToFocusedSizeWithoutSizeDefaultsToLarge()
    {
        $this->SUT->setLayout(Template::AUI_LAYOUT_FOCUSED);
        $this->assertSame('large', $this->SUT->getFocusedLayoutSize());
    }
}

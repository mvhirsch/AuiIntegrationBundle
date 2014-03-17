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

    protected function setUp()
    {
        $this->SUT = new Template(array());
        $this->assertInstanceOf('mvhirsch\Bundle\AuiBundle\Configuration\Template', $this->SUT);
    }

    /**
     * @test
     * @group Configuration
     * @group AUI
     */
    public function getDefaultLayout()
    {
        $this->assertSame('fluid', $this->SUT->getLayout());
    }

    /**
     * @test
     * @group Configuration
     * @group AUI
     */
    public function setLayout()
    {
        $this->SUT->setLayout('hybrid');
        $this->assertSame('hybrid', $this->SUT->getLayout());
    }

    /**
     * @test
     * @expectedException \BadMethodCallException
     */
    public function setLayoutFailsOnInvalidLayout()
    {
        $this->SUT->setLayout('invalid');
    }

    /**
     * @test
     */
    public function setFocusedSize()
    {
        $this->SUT->setFocusedSize('large');
        $this->assertSame('large', $this->SUT->getFocusedSize());
    }

    /**
     * @test
     */
    public function setFocusedSizeFailsOnInvalidSize()
    {
        $this->SUT->setFocusedSize('invalid');
    }
}
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
    public function getDefaultPageLayout()
    {
        $this->assertSame('fluid', $this->SUT->getPageLayout());
    }

    /**
     * @test
     * @group Configuration
     * @group AUI
     */
    public function setPageLayout()
    {
        $this->SUT->setPageLayout('hybrid');
        $this->assertSame('hybrid', $this->SUT->getPageLayout());
    }

    /**
     * @test
     * @expectedException \BadMethodCallException
     */
    public function failOnInvalidPageLayout()
    {
        $this->SUT->setPageLayout('invalid');
    }
}
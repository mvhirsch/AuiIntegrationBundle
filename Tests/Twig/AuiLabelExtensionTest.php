<?php

namespace mvhirsch\Bundle\AuiBundle\Tests\Twig;

use mvhirsch\Bundle\AuiBundle\Twig\AuiLabelExtension;

/**
 * Description of AuiLabelExtensionTest
 *
 * @author meh
 */
class AuiLabelExtensionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * System Under Test
     *
     * @var AuiLabelExtension
     */
    protected $SUT = null;

    protected function setUp()
    {
        $this->SUT = new AuiLabelExtension();
    }
}

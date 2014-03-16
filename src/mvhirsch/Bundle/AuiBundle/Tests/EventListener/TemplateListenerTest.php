<?php

namespace mvhirsch\Bundle\AuiBundle\Tests\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use mvhirsch\Bundle\AuiBundle\EventListener\TemplateListener;
use mvhirsch\Bundle\AuiBundle\Configuration\Template;

class TemplateListenerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');

        $this->request = new Request();
        $this->listener = new TemplateListener($container);
    }

    /**
     * @test
     */
    public function addsPageLayoutToRequest()
    {
        $kernel = $this->getMock('Symfony\Component\HttpKernel\HttpKernelInterface');
        $event = new FilterControllerEvent($kernel, array(new TestController(), 'execute'), $this->request, HttpKernelInterface::MASTER_REQUEST);

        $this->request->attributes->set('_template', new Template(array()));
        $this->listener->onKernelController($event);

        $attributes = $this->request->attributes;
        $this->assertNotNull($attributes->get('_template_vars_aui'));
        $this->assertSame('fluid', $attributes->get('_template_vars_aui')['aui_page_layout']);
    }
}

/**
 * @Template()
 */
class TestController
{
    public function execute(Request $request) {}
}
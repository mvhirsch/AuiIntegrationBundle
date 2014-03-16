<?php

namespace mvhirsch\Bundle\AuiBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\DependencyInjection\ContainerInterface;

class TemplateListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container = null;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Guesses the template name to render and its variables and adds them to
     * the request object.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(\Symfony\Component\HttpKernel\Event\FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        $request = $event->getRequest();

        if (!$configuration = $request->attributes->get('_template')) {
            return;
        }

        if (get_class($configuration) === 'mvhirsch\Bundle\AuiBundle\Configuration\Template') {
            $aui = ['aui_page_layout' => $configuration->getPageLayout()];
            $request->attributes->set('_template_vars_aui', $aui);
        }
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $vars = $request->attributes->get('_template_vars');
        $templating = $this->container->get('templating');

        $parameters = array();
        foreach ($vars as $var) {
            $parameters[$var] = $request->attributes->get($var);
        }

        // it works!
        $parameters['aui'] = ['page_layout' => $request->attributes->get('_template_vars_aui')['aui_page_layout']];

        if (!$template = $request->attributes->get('_template')) {
            return $parameters;
        }

//        var_dump($request->attributes); die();
//        $parameters['aui_page_layout'] = $

        if (!$request->attributes->get('_template_streamable')) {
            $event->setResponse($templating->renderResponse($template, $parameters));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::VIEW => array('onKernelView', 1),
        );
    }
}
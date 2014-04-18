<?php

namespace mvhirsch\Bundle\AuiBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
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

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Appends needed AUI template variables to Request.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        $request = $event->getRequest();
        if (!$configuration = $request->attributes->get('_template')) {
            return;
        }

        if (get_class($configuration) === 'mvhirsch\Bundle\AuiBundle\Configuration\Template') {
            if ('focused' === $configuration->getLayout() && null === $configuration->getFocusedLayoutSize()) {
                throw new \LogicException('Must set @Template::FocusedSize');
            }

            $aui = array(
                'page_layout'   => $configuration->getLayout(),
                'focused_size'  => $configuration->getFocusedLayoutSize(),
            );

            $request->attributes->set('_template_vars_aui', $aui);
        }
    }

    /**
     * Appends the necessary AUI template variables to engine.
     *
     * @param GetResponseForControllerResultEvent $event
     * @return array
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $vars = $request->attributes->get('_template_vars');
        $templating = $this->container->get('templating');

        $parameters = array();
        foreach ($vars as $var) {
            $parameters[$var] = $request->attributes->get($var);
        }

        $parameters['aui'] = ['page_layout' => $request->attributes->get('_template_vars_aui')['page_layout']];

        if (!$template = $request->attributes->get('_template')) {
            return $parameters;
        }

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

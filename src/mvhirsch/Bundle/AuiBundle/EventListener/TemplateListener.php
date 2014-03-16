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

////        var_dump(!$configuration->getTemplate()); die();
////        var_dump($configuration->getTemplatea()); die();
//        if (get_class($configuration) === "Symfony\Bundle\FrameworkBundle\Templating\TemplateReference") {
//            throw new \Exception("wtf?");
//        }
//        if (!$configuration->getTemplate()) {
//            $guesser = $this->container->get('sensio_framework_extra.view.guesser');
//            $configuration->setTemplate($guesser->guessTemplateName($controller, $request, $configuration->getEngine()));
//        }

//        $request->attributes->set('_template', $configuration->getTemplate());
//        $request->attributes->set('_template_vars', $configuration->getVars());
//        $request->attributes->set('_template_streamable', $configuration->isStreamable());

//        var_Dump($request->attributes); die('ok');
        $aui = ['aui_page_layout' => $configuration->getPageLayout()];
        $request->attributes->set('_template_vars_aui', $aui);

        // all controller method arguments
//        if (!$configuration->getVars()) {
//            $r = new \ReflectionObject($controller[0]);
//
//            $vars = array();
//            foreach ($r->getMethod($controller[1])->getParameters() as $param) {
//                $vars[] = $param->getName();
//            }
//
//            $request->attributes->set('_template_default_vars', $vars);
//        }
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
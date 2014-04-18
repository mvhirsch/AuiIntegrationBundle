<?php

namespace mvhirsch\Bundle\AuiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use mvhirsch\Bundle\AuiBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     *
     * // layout="{focused, large}" ??
     * @Template(vars={"name"}, layout={"focused", "large"})
     */
    public function indexAction($name)
    {
        //return array('name' => $name . 'asdf');
    }
}

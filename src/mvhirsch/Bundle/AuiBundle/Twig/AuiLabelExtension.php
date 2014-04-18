<?php

namespace mvhirsch\Bundle\AuiBundle\Twig;

/**
 * Description of AuiLabelExtension
 *
 * @author meh
 */
class AuiLabelExtension extends \Twig_Extension
{

    public function generateLabel($text, $uri = null, $removeable = false)
    {
        return '';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('aui_label', array($this, 'generateLabel')),
        );
    }

    public function getName()
    {
        return 'aui_label_extension';
    }
}

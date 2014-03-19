<?php

namespace mvhirsch\Bundle\AuiBundle\Twig;

class AuiLozengesExtension extends \Twig_Extension
{
    public function generateLozenge($text, $type = null)
    {
        if (null !== $type) {
            return sprintf('<span class="aui-lozenge aui-lozenge-%s">%s</span>', $type, $text);
        }

        return sprintf('<span class="aui-lozenge">%s</span>', $text);
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('aui_lozenge', array($this, 'generateLozenge')),
        );
    }

    public function getName()
    {
        return 'aui_lozenges_extension';
    }
}
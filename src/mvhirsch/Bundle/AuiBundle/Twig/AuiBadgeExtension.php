<?php

namespace mvhirsch\Bundle\AuiBundle\Twig;

/**
 * Generates a Badge (AUI).
 *
 * @example aui_badge(3) // generates <span class="aui-badge">3</span>
 *
 * @author mvhirsch <michael.vhirsch@gmail.com>
 */
class AuiBadgeExtension extends \Twig_Extension
{

    /**
     * Generates a Badge (AUI).
     *
     * @param mixed $text
     *
     * @return string
     */
    public function generateBadge($text)
    {
        return sprintf('<span class="aui-badge">%s</span>', $text);
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('aui_badge', array($this, 'generateBadge')),
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'aui_badge_extension';
    }
}

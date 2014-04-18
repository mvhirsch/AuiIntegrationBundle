<?php

namespace mvhirsch\AuiIntegrationBundle\Twig;

/**
 * Generates a Lozenge (AUI).
 *
 * @example aui_lozenge('message', 'complete', true)
 *
 * @author mvhirsch <michael.vhirsch@gmail.com>
 */
class AuiLozengesExtension extends \Twig_Extension
{
    /**
     * The allowed types for a lozenge.
     *
     * @var array
     */
    protected $allowedTypes = array('success', 'error', 'current', 'complete', 'moved');

    /**
     * Generates the Lozenge defined in AUI.
     *
     * @param string $text   The message text in the Lozenge.
     * @param string $type   The type of the lozenge. Allowed: success, error, current, complete and moved.
     * @param bool   $subtle Subtle it?
     *
     * @throws \InvalidArgumentException On invalid type.
     *
     * @return string
     */
    public function generateLozenge($text, $type = null, $subtle = false)
    {
        if (null !== $type && !in_array($type, $this->allowedTypes)) {
            $message = sprintf('AUI Lozenge allowes only: %s - got "%s"', join(', ', $this->allowedTypes), $type);
            throw new \InvalidArgumentException($message);
        }

        $classes = trim(sprintf(
            'aui-lozenge %s %s',
            (null !== $type) ? 'aui-lozenge-' . $type : null,
            ($subtle) ? 'aui-lozenge-subtle' : null
        ));

        return sprintf('<span class="%s">%s</span>', $classes, $text);
    }

    /**
     * {@inheritDoc}
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('aui_lozenge', array($this, 'generateLozenge')),
        );
    }

    /**
     * {@inheritDoc}
     * @return string
     */
    public function getName()
    {
        return 'aui_lozenges_extension';
    }
}

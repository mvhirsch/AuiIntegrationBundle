<?php

namespace mvhirsch\AuiIntegrationBundle\Twig;

/**
 * Generates a message (AUI).
 *
 * @example aui_message('a default message')
 * @example aui_message('an error message', 'error')
 *
 * @author mvhirsch <michael.vhirsch@gmail.com>
 */
class AuiMessageExtension extends \Twig_Extension
{
    /**
     * The allowed types for a message.
     *
     * @var array
     */
    protected $allowedTypes = array('default', 'warning', 'error', 'success', 'hint');

    /**
     * Generates an AUI Message.
     *
     * @param string $type    Type of message, can be: default, warning, error, success or hint.
     * @param string $title   The title of the message, can be null.
     * @param string $message The message.
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function generateMessage($type, $title, $message)
    {
        if (!in_array($type, $this->allowedTypes)) {
            throw new \InvalidArgumentException(sprintf('AUI Message only allows: %s - got "%s"', join(', ', $this->allowedTypes), $type));
        }

        $classes = (in_array($type, array('warning', 'error', 'success', 'hint'))) ? 'aui-icon icon-' . $type : 'aui-icon';
        $title = (null !== $title) ? sprintf('<p class="title"><span class="%s"></span><strong>%s</strong></p>', $classes, $title) : '';

        return sprintf('<div class="%s">%s<p>%s</p></div>', 'aui-message', $title, $message);
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('aui_message', array($this, 'generateMessage')),
        );
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'aui_message_extension';
    }
}

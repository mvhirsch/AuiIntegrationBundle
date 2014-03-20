<?php

namespace mvhirsch\Bundle\AuiBundle\Twig;

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

    /*
     * warning, error, success, hint
     *
     * default-icon: icon-generic
     *
     * <div class="aui-message [warning]"
     *  <p class="title">
     *      <span class="aui-icon icon-generic"></span>
     *      <strong>Backup Title</strong>
     * </p>
     * <p>message</p>
     * </div>
     */

    public function generateMessage($type, $title, $message)
    {
        if (!in_array($type, $this->allowedTypes)) {
            throw new \InvalidArgumentException(sprintf('AUI Message only allows: %s - got "%s"', join(', ', $this->allowedTypes), $type));
        }

        $title = (null !== $title) ? sprintf('<p class="title"><span class="aui-icon"></span>%s</p>', $title) : '';

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
        return 'aui_message_extensions';
    }

//    public function generateLozenge($text, $type = null, $subtle = false)
//    {
//        if (null !== $type && !in_array($type, $this->allowedTypes)) {
//            $message = sprintf('AUI Lozenge allowes only: %s - got "%s"', join(', ', $this->allowedTypes), $type);
//            throw new \InvalidArgumentException($message);
//        }
//
//        $classes = trim(sprintf(
//            'aui-lozenge %s %s',
//            (null !== $type) ? 'aui-lozenge-' . $type : null,
//            ($subtle) ? 'aui-lozenge-subtle' : null
//        ));
//
//        return sprintf('<span class="%s">%s</span>', $classes, $text);
//    }
//
//    /**
//     * {@inheritDoc}
//     * @return array
//     */
//    public function getFunctions()
//    {
//        return array(
//            new \Twig_SimpleFunction('aui_lozenge', array($this, 'generateLozenge')),
//        );
//    }
//
//    /**
//     * {@inheritDoc}
//     * @return string
//     */
//    public function getName()
//    {
//        return 'aui_lozenges_extension';
//    }
}

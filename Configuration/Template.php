<?php

namespace mvhirsch\AuiIntegrationBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as SymfonyTemplate;

/**
 * @Annotation
 */
class Template extends SymfonyTemplate
{
    const AUI_LAYOUT_DEFAULT = 'fluid';
    const AUI_LAYOUT_FLUID   = 'fluid';
    const AUI_LAYOUT_HYBRID  = 'hybrid';
    const AUI_LAYOUT_FOCUSED = 'focused';

    const AUI_FOCUSED_LAYOUT_SIZE_LARGE = 'large';
    const AUI_FOCUSED_LAYOUT_SIZE_SMALL = 'small';

    /**
     * The AUI-Layout Name.
     *
     * @var string
     */
    protected $layout = null;

    /**
     * The Layout-Size on AUI-Layout "focused".
     *
     * @var string
     */
    protected $focusedSize = null;

    /**
     * Returns the AUI-Layout Name.
     *
     * @return string
     */
    public function getLayout()
    {
        if (null === $this->layout) {
            return self::AUI_LAYOUT_DEFAULT;
        }

        return $this->layout;
    }

    /**
     * Sets the AUI Layout.
     *
     * @param string|array $layout
     *
     * @throws \BadMethodCallException on invalid Layout Name
     */
    public function setLayout($layout)
    {
        if (!is_array($layout)) {
            $layout = array($layout);
        }

        if (!in_array($layout[0], array('fluid', 'fixed', 'hybrid', 'focused'))) {
            throw new \BadMethodCallException('Layout must be: fluid, fixed, hybrid or focused');
        }

        $this->layout = $layout[0];
        $this->focusedSize = (isset($layout[1]) ? $layout[1] : 'large');
    }

    /**
     * Returns the Layout-Size on AUI-Layout "Focused"
     *
     * @return string
     */
    public function getFocusedLayoutSize()
    {
        if (null === $this->focusedSize && 'focused' === $this->layout) {
            return 'large';
        }

        return $this->focusedSize;
    }
}

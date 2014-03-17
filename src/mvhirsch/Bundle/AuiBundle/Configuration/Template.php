<?php

namespace mvhirsch\Bundle\AuiBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as SymfonyTemplate;

/**
 * @Annotation
 */
class Template extends SymfonyTemplate
{

    /**
     * The PageLayout by AUI.
     *
     * @var string
     */
    protected $pageLayout = 'fluid'; // default AUI Layout

    /**
     * The ContentLayout by AUI.
     *
     * @var string
     */
    protected $contentLayout = 'content'; // content-only

    protected $focusedSize = null;

    public function getLayout()
    {
        return $this->pageLayout;
    }

    public function setLayout($layout)
    {
        if (!in_array($layout, array('fluid', 'fixed', 'hybrid', 'focused'))) {
            throw new \BadMethodCallException(sprintf('Page layout must be on of these: fluid, fixed or hybrid'));
        }

        $this->pageLayout = $layout;
    }

    public function getFocusedSize()
    {
        return $this->focusedSize;
    }

    public function setFocusedSize($size)
    {
        $this->focusedSize = $size;
    }
}
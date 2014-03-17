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

    public function getLayout()
    {
        return $this->pageLayout;
    }

    public function setLayout($layout)
    {
        if (!in_array($layout, array('fluid', 'fixed', 'hybrid'))) {
            throw new \BadMethodCallException(sprintf('Page layout must be on of these: fluid, fixed or hybrid'));
        }

        $this->pageLayout = $layout;
    }
}
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

    public function getPageLayout()
    {
        return $this->pageLayout;
    }

    public function setPageLayout($layout)
    {
        if (!in_array($layout, array('fluid', 'fixed', 'hybrid'))) {
            throw new \BadMethodCallException(sprintf('Page layout must be on of these: fluid, fixed or hybrid'));
        }

        $this->pageLayout = $layout;
    }

    public function getVars()
    {
        $this->vars[] = 'pageLayout';
//        var_dump($this->vars); die();
//        $this->vars['AuiPageLayout'] = $this->pageLayout = array('test');
        return array_merge($this->vars, array()); //array('AuiPageLayout' => $this->pageLayout));
    }
}
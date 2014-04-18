# mvhirsch/AuiBundle

Integrates the Atlassian User Interface.
Atlassian User Interface is licensed under Apache License v2.0.
Is shipped with AUI v5.4.1.

## Dependencies
* DomCrawler
* Twig
* Symfony ~2.x (2.4)

## Twig Functions
* aui_badge(3) // generates an AUI-Badge with content "3"
* aui_lozenge('test') // generates an AUI-Lozenge with content "test" and default type
* aui_message('error', 'an error occured', 'there was an error while saving the form') // generates an AUI-Message of type error

## Installation
Use `base.html.twig`

## Change Page Layout
As defined in ADG, you can use the following page layouts: fluid (default), hybrid and fixed.

    use mvhirsch\Bundle\AuiBundle\Configuration\Template

    [...]

    /**
     *  @Template(layout="hybrid")
     */
    public function AcmeIndexAction() {}


## ToDo
* Template as Annotation
* Keyboard-Shortcut Configuration and linking with Controller-Actions (Expression-Language/Annoation-Extra?)
* AUI-Page Pagerfanta Integration
* ApplicationHeader / MenuBundle
* Rename AuiBundle -> AuiIntegrationBundle
* Refactor directory structure (acutally its a full symfony project)
* Add License (MIT?)
* Remove shipped AUI v5.4.1, include a "install" script?
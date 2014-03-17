mvhirsch/AuiBundle
======================

Integrates the Atlassian User Interface.
Atlassian User Interface is licensed under Apache License v2.0.
Is shipped with AUI v5.4.1.

Installation
----------------
Use `base.html.twig`

Change Page Layout
-----------------
As defined in ADG, you can use the following page layouts: fluid (default), hybrid and fixed.

    use mvhirsch\Bundle\AuiBundle\Configuration\Template

    [...]

    /**
     *  @Template(layout="hybrid")
     */
    public function AcmeIndexAction() {}


ToDo
----------------
* Template as Annotation
* Keyboard-Shortcut Configuration and linking with Controller-Actions (Expression-Language/Annoation-Extra?)
* AUI-Page Pagerfanta Integration
* ApplicationHeader / MenuBundle
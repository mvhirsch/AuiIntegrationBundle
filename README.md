# mvhirsch/AuiIntegrationBundle
Integrates the Atlassian User Interface.
For more details, please have a look at the [Atlassian Design Guidelines](https://developer.atlassian.com/design/latest/).
Atlassian User Interface is licensed under Apache License v2.0.

This Bundle will not shipped with AUI.
But you can still download the newest version under: [Downloads | Atlassian Design Guidelines](https://developer.atlassian.com/design/latest/).
Just download the flat pack and move the "aui"-folder into the public directory.

## State of this project
Because I'm very busy and I'm also not in need to write such a bundle, I *do not actively* develop this bundle.
However, if you're in need of this bundle, send me an email and get in touch with me.

If somebody want to use this bundle I'm willing to help - I promise.
And of course, please feel free to use and contribute this project.

## Installation
* [AUI-Flat-Pack >=5.4.1](https://developer.atlassian.com/design/1.3/downloads/)
* DomCrawler
* Twig
* Symfony ~2.x (2.4)

## Run Tests
Just run:

`phpunit`

## Using the AuiIntegrationBundle
The AuiIntegrationBundle provides many helpers to get started fast with AUI.

### Configuration
Add the AuiIntegrationBundle() to your AppKernel.
And of course, use the `base.html.twig` as your base template.

### Change Page Layout
As defined in ADG, you can use the following page layouts: fluid (default), hybrid and fixed.

    use mvhirsch\AuiIntegrationBundle\Configuration\Template

    [...]

    /**
     *  @Template(layout="hybrid")
     */
    public function AcmeIndexAction() {}

### Twig Functions
* `aui_badge(3)`

   generates an AUI-Badge with content "3"

* `aui_lozenge('test')`

   generates an AUI-Lozenge with content "test" and default type

* `aui_message('error', 'an error occured', 'there was an error while saving the form')`

   generates an AUI-Message of type error

* more coming ...

### ToDo
As mentioned above, this bundle lacks some core features.

* ~~Template as Annotation~~
* Keyboard-Shortcut Configuration and linking with Controller-Actions (Expression-Language/Annoation-Extra?)
* AUI-Page Pagerfanta Integration
* ApplicationHeader / MenuBundle
* ~~Rename AuiBundle -> AuiIntegrationBundle~~
* ~~Include an install script to automatically provider AUI~~
* Add aui-flatpack as webcomponent to packagist and as a requirement to this bundle
# Twig Bridge Bundle

Bridge to provide Twig extensions (https://github.com/tentwofour/twig) into Symfony2.

## Enable in AppKernel

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Ten24\SymfonyTwigBridgeBundle\Ten24SymfonyTwigBridgeBundle()
        )
        ...
    }
    ...
}
```

## Usage

By default, the bundle registers all extensions from https://github.com/tentwofour/twig by default. See that bundle for extension documentation.

Any/all extensions can be disabled via bundle configuration:

```yml
# app/config.yml

ten24_twig:
    email: false
    diff: false
    money: false
    number: false
```
# Twig Bridge Bundle

Bridge to provide Twig extensions (https://github.com/tentwofour/twig) into Symfony2.

## Enable

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

The bundle registers all extensions from https://github.com/tentwofour/twig by default. See that bundle for extension documentation.
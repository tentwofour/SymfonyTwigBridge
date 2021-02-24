# Form Bridge Bundle

Bridge to provide Form extensions (https://github.com/tentwofour/sf2-form) into Symfony2.

## Enable

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Ten24\Symfony\FormBridgeBundle\Ten24SymfonyFormBridgeBundle()
        )
        ...
    }
    ...
}
```

## Usage

The bundle registers all extensions from https://github.com/tentwofour/sf2-form by default. See that bundle for extension documentation.
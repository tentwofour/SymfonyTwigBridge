<?php

namespace Ten24\SymfonyTwigBridge;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Ten24\SymfonyTwigBridge\DependencyInjection\TwigBridgeExtension;

class Ten24SymfonyTwigBridgeBundle extends Bundle
{
    /**
     * @var string
     */
    private $configurationAlias;

    /**
     * Ten24SymfonyTwigBridgeBundle constructor.
     *
     * @param string $alias
     */
    public function __construct($alias = 'ten24_twig')
    {
        // @todo - replace alias in compiler pass/Extension upon config load
        $this->configurationAlias = 'ten24_twig';
    }

    /**
     * @return \Ten24\SymfonyTwigBridge\DependencyInjection\TwigBridgeExtension
     */
    public function getContainerExtension()
    {
        return new TwigBridgeExtension($this->configurationAlias);
    }
}
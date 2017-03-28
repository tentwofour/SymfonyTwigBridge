<?php

namespace Ten24\Tests\SymfonyTwigBridge\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;
use Ten24\SymfonyTwigBridge\DependencyInjection\TwigBridgeExtension;

class TwigBridgeExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerBuilder */
    protected $configuration;

    protected $defaultExtensionNamespace = 'ten24_twig';

    protected $customExtensionNamespace = 'ten24_custom_twig';

    public function testExtensionConstructorWithDefaultNamespace()
    {
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        self::assertEquals($this->defaultExtensionNamespace, $loader->getAlias());
    }

    public function testExtensionConstructorWithCustomNamespace()
    {
        $loader = new TwigBridgeExtension($this->customExtensionNamespace);
        self::assertEquals($this->customExtensionNamespace, $loader->getAlias());
    }

    public function testLoadWithEmptyConfiguration()
    {
        $this->createEmptyConfiguration();
        $this->assertHasDefinition('ten24_twig.extension.emailencode');
        $this->assertHasDefinition('ten24_twig.extension.diff');
        $this->assertHasDefinition('ten24_twig.extension.money');
        $this->assertHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadWithDisabledEmailExtension()
    {
        $this->createEmailDisabledConfiguration();

        $this->assertNotHasDefinition('ten24_twig.extension.emailencode');
        $this->assertHasDefinition('ten24_twig.extension.diff');
        $this->assertHasDefinition('ten24_twig.extension.money');
        $this->assertHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadWithDisabledDiffExtension()
    {
        $this->createDiffDisabledConfiguration();

        $this->assertHasDefinition('ten24_twig.extension.emailencode');
        $this->assertNotHasDefinition('ten24_twig.extension.diff');
        $this->assertHasDefinition('ten24_twig.extension.money');
        $this->assertHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadWithDisabledMoneyExtension()
    {
        $this->createMoneyDisabledConfiguration();

        $this->assertHasDefinition('ten24_twig.extension.emailencode');
        $this->assertHasDefinition('ten24_twig.extension.diff');
        $this->assertNotHasDefinition('ten24_twig.extension.money');
        $this->assertHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadWithDisabledNumberExtension()
    {
        $this->createNumberDisabledConfiguration();

        $this->assertHasDefinition('ten24_twig.extension.emailencode');
        $this->assertHasDefinition('ten24_twig.extension.diff');
        $this->assertHasDefinition('ten24_twig.extension.money');
        $this->assertNotHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadWithAllExtensionsDisabled()
    {
        $this->createAllDisabledConfiguration();

        $this->assertNotHasDefinition('ten24_twig.extension.emailencode');
        $this->assertNotHasDefinition('ten24_twig.extension.diff');
        $this->assertNotHasDefinition('ten24_twig.extension.money');
        $this->assertNotHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadDefaultTwigExtensionClasses()
    {
        $this->createEmptyConfiguration();

        $this->assertParameter('Ten24\Twig\Extension\EmailEncodingExtension', 'ten24_twig.extension.emailencode.class');
        $this->assertParameter('Ten24\Twig\Extension\DiffExtension', 'ten24_twig.extension.diff.class');
        $this->assertParameter('Ten24\Twig\Extension\MoneyExtension', 'ten24_twig.extension.money.class');
        $this->assertParameter('Ten24\Twig\Extension\NumberExtension', 'ten24_twig.extension.number.class');
    }

    /**
     * getEmptyConfig.
     *
     * @return array
     */
    protected function getEmptyConfig()
    {
        $yaml   = <<<EOF
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    /**
     * @return mixed
     */
    protected function getFullConfig()
    {
        $yaml   = <<<EOF
email: true
diff: true
money: true
number: true
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    protected function getFullDisabledConfig()
    {
        $yaml   = <<<EOF
email: false
diff: false
money: false
number: false
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    protected function createEmptyConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        $config = $this->getEmptyConfig();
        $loader->loadInternal(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    protected function createEmailDisabledConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        $config = $this->getFullConfig();

        $config['email'] = false;

        $loader->loadInternal(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    protected function createDiffDisabledConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        $config = $this->getFullConfig();

        $config['diff'] = false;

        $loader->loadInternal(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    protected function createMoneyDisabledConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        $config = $this->getFullConfig();

        $config['money'] = false;

        $loader->loadInternal(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    protected function createNumberDisabledConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        $config = $this->getFullConfig();

        $config['number'] = false;

        $loader->loadInternal(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    protected function createAllDisabledConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new TwigBridgeExtension($this->defaultExtensionNamespace);
        $config = $this->getFullConfig();

        $config['email'] = false;
        $config['diff'] = false;
        $config['money'] = false;
        $config['number'] = false;

        $loader->loadInternal(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }

    /**
     * @param mixed  $value
     * @param string $key
     */
    private function assertParameter($value, $key)
    {
        self::assertSame($value, $this->configuration->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    /**
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        self::assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    /**
     * @param string $id
     */
    private function assertNotHasDefinition($id)
    {
        self::assertFalse(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    protected function tearDown()
    {
        unset($this->configuration);
    }
}

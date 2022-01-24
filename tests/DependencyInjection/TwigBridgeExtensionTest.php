<?php

namespace Ten24\Tests\Bundle\TwigBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;
use Ten24\Bundle\TwigBundle\DependencyInjection\Ten24TwigExtension;

class TwigBridgeExtensionTest extends TestCase
{
    /** @var ContainerBuilder */
    protected $container;

    public function testExtensionConstructor()
    {
        $loader = new Ten24TwigExtension();
        self::assertEquals('ten24_twig', $loader->getAlias());
    }

    public function testLoadWithEmptyConfiguration()
    {
        $this->createEmptyConfiguration();
        $this->assertNotHasDefinition('ten24_twig.extension.emailencode');
        $this->assertNotHasDefinition('ten24_twig.extension.diff');
        $this->assertNotHasDefinition('ten24_twig.extension.inflector');
        $this->assertNotHasDefinition('ten24_twig.extension.money');
        $this->assertNotHasDefinition('ten24_twig.extension.number');
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

    public function testLoadWithDisabledInflectorExtension()
    {
        $this->createInflectorDisabledConfiguration();

        $this->assertHasDefinition('ten24_twig.extension.emailencode');
        $this->assertHasDefinition('ten24_twig.extension.diff');
        $this->assertNotHasDefinition('ten24_twig.extension.inflector');
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
        $this->assertNotHasDefinition('ten24_twig.extension.inflector');
        $this->assertNotHasDefinition('ten24_twig.extension.money');
        $this->assertNotHasDefinition('ten24_twig.extension.number');
    }

    public function testLoadDefaultTwigExtensionClasses()
    {
        $this->createEmptyConfiguration();

        // Should all be unset
        $this->assertNotParameter('Ten24\Twig\Extension\EmailEncodingExtension', 'ten24_twig.extension.emailencode.class');
        $this->assertNotParameter('Ten24\Twig\Extension\DiffExtension', 'ten24_twig.extension.diff.class');
        $this->assertNotParameter('Ten24\Twig\Extension\InflectorExtension', 'ten24_twig.extension.inflector.class');
        $this->assertNotParameter('Ten24\Twig\Extension\MoneyExtension', 'ten24_twig.extension.money.class');
        $this->assertNotParameter('Ten24\Twig\Extension\NumberExtension', 'ten24_twig.extension.number.class');
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
inflector: true
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
inflector: false
money: false
number: false
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    protected function createEmptyConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config          = $this->getEmptyConfig();
        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function createEmailDisabledConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config              = $this->getFullConfig();

        $config['email'] = false;

        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function createDiffDisabledConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config              = $this->getFullConfig();

        $config['diff'] = false;

        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function createInflectorDisabledConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config              = $this->getFullConfig();

        $config['inflector'] = false;

        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function createMoneyDisabledConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config              = $this->getFullConfig();

        $config['money'] = false;

        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function createNumberDisabledConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config              = $this->getFullConfig();

        $config['number'] = false;

        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function createAllDisabledConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new Ten24TwigExtension();
        $config              = $this->getFullDisabledConfig();

        $loader->load([$config], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    /**
     * @param mixed  $value
     * @param string $key
     */
    private function assertParameter($value, $key)
    {
        self::assertSame($value, $this->container->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    /**
     * @param mixed  $value
     * @param string $key
     */
    private function assertNotParameter($value, $key)
    {
        self::expectException('Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException');
        self::assertEmpty($value, $this->container->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    /**
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        self::assertTrue(($this->container->hasDefinition($id) ?: $this->container->hasAlias($id)));
    }

    /**
     * @param string $id
     */
    private function assertNotHasDefinition($id)
    {
        self::assertFalse(($this->container->hasDefinition($id) ?: $this->container->hasAlias($id)));
    }

    protected function tearDown(): void
    {
        unset($this->container);
    }
}

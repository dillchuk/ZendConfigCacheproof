<?php

namespace ZendConfigCacheproofTest\Config;

use ZendConfigCacheproof\Config\ConfigFactory;
use ZendConfigCacheproof\Loader\EnvironmentVariable as EnvLoader;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Service\ConfigFactory as ParentFactory;

class ConfigFactoryTest extends \PHPUnit_Framework_TestCase {

    const ENV_VAR = 'ConfigFactoryTest_LOCAL';

    /**
     * @dataProvider dataConfigFactory
     */
    public function testConfigFactory($loaders) {
        $container = $this->getMock(ContainerInterface::class);
        $container->expects($this->any())->method('get')->willReturn($loaders);

        $parentFactory = $this->getMock(ParentFactory::class, ['__invoke']);
        $parentFactory->expects($this->any())->method('__invoke')->willReturn([]);

        $factory = new ConfigFactory;
        $factory->setParentFactory($parentFactory);

        $config = $factory($container, null);
        $this->assertEmpty($config);

        putenv(static::ENV_VAR . '=1');
        $config = $factory($container, null);
        $this->assertTrue((bool) $config['cacheproof_hello_world']);
        $this->assertTrue((bool) $config['cacheproof_hello_world_2']);
        putenv(static::ENV_VAR . '=');

        $config = $factory($container, null);
        $this->assertEmpty($config);
    }

    public static function dataConfigFactory() {
        $loader = new EnvLoader(static::ENV_VAR);
        $loader->setGlob(__DIR__ . '/data/{{,*.}cacheproof}.php');
        return [
            [$loader],
            [[$loader]],
        ];
    }

    public function testGetParentFactory() {
        $factory = new ConfigFactory;
        $this->assertInstanceOf(
        ParentFactory::class, $factory->getParentFactory()
        );
    }

}

<?php

namespace ZendConfigCacheproofTest\Config;

use ZendConfigCacheproof\Config\ConfigFactory;
use ZendConfigCacheproof\Loader\EnvironmentVariable as EnvLoader;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Service\ConfigFactory as ParentFactory;

class ConfigFactoryTest extends \PHPUnit_Framework_TestCase {

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
        $factory($container, null);
    }

    public static function dataConfigFactory() {
        $loader = new EnvLoader('test');
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

<?php

namespace ZendConfigCacheproofTest\Loader;

use ZendConfigCacheproof\Loader\DefaultFactory;
use ZendConfigCacheproof\Loader\DefaultLoader;
use Interop\Container\ContainerInterface;

class DefaultFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testDefaultFactory() {
        $container = $this->getMock(ContainerInterface::class);
        $factory = new DefaultFactory;
        $loaders = $factory($container, null);
        $this->assertCount(1, $loaders);
        $this->assertEquals(DefaultLoader::DEFAULT_GLOB, $loaders[0]->getGlob());
    }

}

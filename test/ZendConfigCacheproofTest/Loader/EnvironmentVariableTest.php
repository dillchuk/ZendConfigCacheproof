<?php

namespace ZendConfigCacheproofTest\Loader;

use ZendConfigCacheproof\Loader\EnvironmentVariable as EnvLoader;
use ZendConfigCacheproof\Loader\DefaultLoader;

class EnvironmentVariableTest extends \PHPUnit_Framework_TestCase {

    const ENV_VAR = 'EnvironmentVariableTest_LOCAL';

    public function testLoader() {
        $loader = new EnvLoader(static::ENV_VAR);
        //$this->assertNull($loader->getGlob());
        putenv(static::ENV_VAR . '=1');
        $this->assertEquals(
        DefaultLoader::DEFAULT_GLOB, $loader->getGlob()
        );
    }

}

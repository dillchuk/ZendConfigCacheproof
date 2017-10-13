<?php

namespace ZendConfigCacheproofTest\Loader;

use ZendConfigCacheproof\Loader\EnvironmentVariable as EnvLoader;
use ZendConfigCacheproof\Loader\DefaultLoader;

class EnvironmentVariableTest extends \PHPUnit_Framework_TestCase {

    const ENV_VAR = 'EnvironmentVariableTest_LOCAL';

    /**
     * @dataProvider dataLoader
     */
    public function testLoader($envValue, $expectedSuccess) {
        $loader = new EnvLoader(static::ENV_VAR);
        $this->assertNull($loader->getGlob());

        putenv(static::ENV_VAR . "={$envValue}");
        if ($expectedSuccess) {
            $this->assertEquals(DefaultLoader::DEFAULT_GLOB, $loader->getGlob());
        }
        else {
            $this->assertNull($loader->getGlob());
        }
        putenv(static::ENV_VAR . '=');
    }

    public static function dataLoader() {
        return [
            ['1', true],
            ['2', true],
            ['null', true], // don't do this
            ['false', true], // don't do this
            ['0', false],
            ['', false],
        ];
    }

}

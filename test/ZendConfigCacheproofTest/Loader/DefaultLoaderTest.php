<?php

namespace ZendConfigCacheproofTest\Loader;

use ZendConfigCacheproof\Loader\DefaultLoader;

class DefaultLoaderTest extends \PHPUnit_Framework_TestCase {

    /**
     * @param string $glob
     * @dataProvider dataDefaultLoader
     */
    public function testDefaultLoader($glob) {
        $loader = new DefaultLoader;
        $this->assertSame(DefaultLoader::DEFAULT_GLOB, $loader->getGlob());
        $this->assertSame(
        './config/autoload/{{,*.}cacheproof}.php', $loader->getGlob()
        );
        $loader->setGlob($glob);
        $this->assertSame($glob, $loader->getGlob());
    }

    public static function dataDefaultLoader() {
        return [
            ['test'],
            ['./config/autoload/{{,*.}another}.php'],
            ['./config/autoload/{{,*.}live}.php'],
        ];
    }

}

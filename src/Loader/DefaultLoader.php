<?php

namespace ZendConfigCacheproof\Loader;

class DefaultLoader implements LoaderInterface {

    const DEFAULT_GLOB = './config/autoload/{{,*.}cacheproof}.php';

    /**
     * @var string
     */
    protected $glob;

    public function __construct() {
        $this->setGlob(self::DEFAULT_GLOB);
    }

    /**
     * @param string $glob
     */
    public function setGlob($glob) {
        $this->glob = (string) $glob;
    }

    /**
     * @return string
     */
    public function getGlob() {
        return $this->glob;
    }

}

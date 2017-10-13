<?php

namespace ZendConfigCacheproof\Loader;

interface LoaderInterface {

    /**
     * @param string $glob
     */
    public function setGlob($glob);

    /**
     * @return string
     */
    public function getGlob();
}

<?php

namespace ZendConfigCacheproof\Loader;

/**
 * Returns the glob if environment variable is true-ish.
 */
class EnvironmentVariable extends DefaultLoader {

    /**
     * @var string
     */
    protected $envName;

    /**
     * @param string $environmentVariable
     */
    public function __construct($envName) {
        parent::__construct();
        $this->envName = $envName;
    }

    /**
     * @return string
     */
    public function getGlob() {
        if (getenv($this->envName)) {
            return $this->glob;
        }
        return null;
    }

}

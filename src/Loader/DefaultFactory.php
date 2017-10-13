<?php

namespace ZendConfigCacheproof\Loader;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Returns a list of LoaderInterface instances.
 */
class DefaultFactory implements FactoryInterface {

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        return [new DefaultLoader];
    }

}

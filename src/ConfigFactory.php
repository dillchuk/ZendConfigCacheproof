<?php

namespace ZendConfigCacheproof;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Mvc\Service\ConfigFactory as ParentFactory;
use Zend\ModuleManager\Listener\ConfigListener;
use Zend\ModuleManager\ModuleEvent;
use Zend\Stdlib\ArrayUtils;

class ConfigFactory implements FactoryInterface {

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        $parentFactory = new ParentFactory;
        $config = $parentFactory($container, $requestedName, $options);

        if (getenv('INSTANCE_LIVE')) {
            $glob = './config/autoload/{{,*.}cacheproof}.php';
            $configListener = new ConfigListener;
            $configListener->addConfigGlobPath($glob);
            $configListener->onMergeConfig(new ModuleEvent);
            $config = ArrayUtils::merge(
            $config, $configListener->getMergedConfig(false)
            );
        }

        return $config;
    }

}

<?php

namespace ZendConfigCacheproof\Config;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Mvc\Service\ConfigFactory as ParentFactory;
use Zend\ModuleManager\Listener\ConfigListener;
use Zend\ModuleManager\ModuleEvent;
use Zend\Stdlib\ArrayUtils;

class ConfigFactory implements FactoryInterface {

    /**
     * @var FactoryInterface
     */
    protected $parentFactory;

    public function setParentFactory($parentFactory) {
        $this->parentFactory = $parentFactory;
    }

    /**
     * @return FactoryInterface
     */
    public function getParentFactory() {
        if (!$this->parentFactory) {
            $this->parentFactory = new ParentFactory;
        }
        return $this->parentFactory;
    }

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        $parentFactory = $this->getParentFactory();
        $config = $parentFactory($container, $requestedName, $options);

        $loaders = $container->get('cacheproof_loaders');
        is_array($loaders) or $loaders = [$loaders];

        $configListener = new ConfigListener;
        foreach ($loaders as $loader) {
            $glob = $loader->getGlob();
            $glob and $configListener->addConfigGlobPath($glob);
        }
        $configListener->onMergeConfig(new ModuleEvent);
        $config = ArrayUtils::merge(
        $config, $configListener->getMergedConfig(false)
        );

        return $config;
    }

}

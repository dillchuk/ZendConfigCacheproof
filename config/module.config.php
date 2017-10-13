<?php

namespace ZendConfigCacheproof;

return [
    'service_manager' => [
        'factories' => [
            'config' => Config\ConfigFactory::class,
            'cacheproof_loaders' => Loader\DefaultFactory::class,
        ],
    ],
];

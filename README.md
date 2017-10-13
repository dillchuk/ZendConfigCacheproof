# ZendConfigCacheproof

[![Build Status](https://travis-ci.org/dillchuk/ZendConfigCacheproof.svg?branch=master)](https://travis-ci.org/dillchuk/ZendConfigCacheproof)

## Purpose

Caching your config is nice (i.e. using `'module_listener_options' => ['config_cache_enabled' => true]`), but this locks your config right down.  What if you need to tweak things a bit for, say, running tests?  Enter ZendConfigCacheproof.

Install in `modules.config.php`:
~~~
return [
    ..., 'ZendConfigCacheproof', ...
];
~~~

## Easy Start

In `config/autoload`, create `*.cacheproof.php` config files.  (As opposed to the usual `*.global.php` and `*.local.php` files.)  These will be loaded every time.


## Useful Start

You may want your configuration to change based on environment variables; install a `cacheproof_loaders` factory like the following:

~~~
namespace Application\Cacheproof;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use ZendConfigCacheproof\Loader\EnvironmentVariable as EnvLoader;

class LoaderFactory implements FactoryInterface {

    const GLOB_LIVE = './config/autoload/{{,*.}live}.php';
    const ENV_VAR_LIVE = 'INSTANCE_LIVE';

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        $loader = new EnvLoader(static::ENV_VAR_LIVE);
        $loader->setGlob(static::GLOB_LIVE);
        return $loader;
    }

}
~~~

Then, your `./config/autoload/{{,*.}live}.php` config is live-loaded whenever environment variable `INSTANCE_LIVE` is true-ish.

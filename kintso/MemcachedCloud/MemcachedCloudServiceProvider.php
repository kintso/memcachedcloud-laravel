<?php 

namespace kintso\MemcachedCloud;
use Illuminate\Support\ServiceProvider;

// Based on https://github.com/atyagi/elasticache-laravel

class MemcachedCloudServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
            $servers = $this->app['config']->get('cache.memcached');
            $memcachedCloud = new MemcachedCloudConnector();
            $memcached = $memcachedCloud->connect($servers);

            $this->app->register('Illuminate\Cache\CacheServiceProvider');

            $this->app->make('cache')->extend('memcached', function() use ($memcached) {
                /** @noinspection PhpUndefinedNamespaceInspection */
                /** @noinspection PhpUndefinedClassInspection */
                return new \Illuminate\Cache\Repository(
                    new \Illuminate\Cache\MemcachedStore($memcached, $this->app['config']->get('cache.prefix')));
            });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
}

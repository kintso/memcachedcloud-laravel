<?php 

namespace kintso\MemcachedCloud;
use Memcached;

class MemcachedCloudConnector {

    /**
     * Extend the Memcached connection to use MemcachedCloud via Heroku
     *
     * @param array $servers
     * @throws \RuntimeException
     * @return \Memcached
     */
    public function connect(array $servers)
    {
        $memcached = $this->getMemcached();
            
        // Set Elasticache options here
        if (defined('\Memcached::OPT_BINARY_PROTOCOL')) {
            $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        }

        $memcached->addServers(array_map(function($server) { return explode(':', $server, 2); }, explode(',', $_ENV['MEMCACHEDCLOUD_SERVERS'])));
        $memcached->setSaslAuthData($_ENV['MEMCACHEDCLOUD_USERNAME'], $_ENV['MEMCACHEDCLOUD_PASSWORD']);

        if ($memcached->getVersion() === false) {
            throw new \RuntimeException("Could not establish Memcached connection.");
        }

        return $memcached;
    }

    /**
     * Get a new Memcached instance.
     *
     * @return \Memcached
     */
    protected function getMemcached()
    {
        return new Memcached;
    }

}

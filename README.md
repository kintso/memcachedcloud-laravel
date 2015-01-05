memcachedcloud-laravel
======================

This package extends Laravel Cache driver to integrate with MemcachedCloud. MemcachedCloud provides different cache solutions based on memcached or redis. This package only deals with memcached.

**How to install?**

1. Create an account on MemcachedcCloud and a bucket using memcached
2. Download the package via composer
3. Add in your app.php config in the providers array the following line:         
        'providers' => append_config(array(
            'kintso\MemcachedCloud\MemcachedCloudServiceProvider',
        )),
4. The package assumes you have three environment variables for your MemcachedCloud account: MEMCACHEDCLOUD_SERVERS, MEMCACHEDCLOUD_USERNAME and MEMCACHEDCLOUD_PASSWORD

**How it works?**

I wrote this package based on a great work done by @atyagi (https://github.com/atyagi/elasticache-laravel). It extends Laravel Cache memcached driver to connect via SASL to Memcachedcloud service. I needed it for my application as it is hosted on Heroku

It is my first package so please let me know how to improve things :)

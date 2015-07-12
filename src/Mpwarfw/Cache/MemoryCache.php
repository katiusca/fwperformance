<?php

namespace Mpwarfw\Cache;

use Memcache;

class MemoryCache extends Cache
{
    public $memcache ;

    public function __construct()
    {
        $this->memcache = new Memcache();
        $this->memcache->pconnect('192.168.33.10',11211);

    }

	public function set ($params, $content, $expiration)
    {
        $this->memcache->set(self::getKeyName($params),$content, MEMCACHE_COMPRESSED, $expiration);
	}

	public function get ($params)
    {
        return $this->memcache->get(self::getKeyName($params));
	}

	public function delete ($params)
    {
        return $this->memcache->delete(self::getKeyName($params));
	}

}

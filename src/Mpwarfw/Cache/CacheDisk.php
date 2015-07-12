<?php

namespace Mpwarfw\Cache;

class CacheDisK  extends Cache
{

    const  CACHE_PATH = '/tmp/cachedisk';

    public function get($key)
    {
        if(file_exists(self::CACHE_PATH.$key))
        {
            return file_get_contents(self::CACHE_PATH.$key);
        }
        return false;
    }

    public function set($key, $value, $expiration)
    {
        if(!file_exists(self::CACHE_PATH))
        {
            mkdir(self::CACHE_PATH,0777,true);
        }
        file_put_contents(self::CACHE_PATH.$key,$value);
    }

    public function delete($key)
    {
        return unlink(self::CACHE_PATH.$key);
    }

}
<?php

namespace Mpwarfw\DBConnections;

use Predis;

class RedisConnectionPool extends BasicConnectionPool
{
    protected function newConnection()
    {
        Predis\Autoloader::register();

        $connection = new Predis\Client([
            'scheme' => 'tcp',
            'host' => '192.168.33.10',
            'port' => '6379'
        ]);
        return $connection;
    }

}
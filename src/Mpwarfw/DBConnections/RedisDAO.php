<?php

namespace Mpwarfw\DBConnections;

class RedisDAO
{
    private $connectionPool;

    public function __construct()
    {
        $this->connectionPool = new RedisConnectionPool(1,20);
    }

    public function topN($key, $n)
    {
        $conn = $this->connectionPool->getConnection();
        $returnValue = $conn->zrevrange($key, 0, $n-1, "withscores");
        return $returnValue;
    }

    public function incrementBy1($set, $key)
    {
        $conn = $this->connectionPool->getConnection();
        $returnValue = $conn->zincrby($set, 1, $key);
        return $returnValue;
    }

    public function executeCommand($command, $params)
    {
        $conn = $this->connectionPool->getConnection();
        $returnValue = $conn->$command($params);
        $this->connectionPool->returnConnection($conn);
        return $returnValue;
    }

}
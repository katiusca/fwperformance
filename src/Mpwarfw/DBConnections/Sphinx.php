<?php

namespace Mpwarfw\DBConnections;

use Foolz\SphinxQL\Connection;

abstract class Sphinx
{
    protected $sphinx;

    public function __construct($host = '127.0.0.1', $port = 9313)
    {
        $this->sphinx = new Connection();
        $this->sphinx->setParams(array('host' => $host, 'port' => $port));
    }

    public function getConnection()
    {
        return $this->sphinx;
    }

}


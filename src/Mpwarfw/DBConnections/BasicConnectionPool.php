<?php

namespace Mpwarfw\DBConnections;

class BasicConnectionPool implements ConnectionPool
{
    const DATA_PROVIDER_FILE = "../src/Config/dataProvider.json";
    const CHARSET = "utf8";

    private $dataProvider;

    private $minConnections;
    private $maxConnections;
    private $connections;

    public function __construct($min, $max)
    {
        $this->connections = array();
        $dataProviderFile = file_get_contents(self::DATA_PROVIDER_FILE);
        $this->dataProvider = json_decode($dataProviderFile);

        $this->minConnections = $min;
        $this->maxConnections = $max;

        if($this->minConnections>0)
        {
            for($i=0;$i<$this->minConnections;$i++)
            {
                $conn = $this->newConnection();
                array_push($this->connections, array($conn, false));
            }
        }
    }

    public function getConnection()
    {
        if(count($this->connections)<=0)
        {
            $conn = $this->newConnection();
            array_push($this->connections, array($conn, false));
            return $conn;
        }else
        {
            foreach($this->connections as $conn)
            {
                if($conn[0]!=null && $conn[1]){
                    $conn[1] = false;
                    return $conn[0];
                }
            }
            if(count($this->connections)==$this->maxConnections){
                throw new \Exception("Max connections reached");
            }
            else
            {
                $conn = $this->newConnection();
                array_push($this->connections, array($conn, false));
                return $conn;
            }
        }
    }

    public function returnConnection($connection)
    {
        foreach($this->connections as $conn)
        {
            if($conn[0]==$connection && !$conn[1]){
                $conn[1] = true;
            }
        }
    }

    protected function newConnection()
    {
        try
        {
            $connection = new \PDO('mysql:host='.$this->dataProvider->{'host'}.';dbname='.$this->dataProvider->{'dbName'}.';charset='.self::CHARSET, $this->dataProvider->{'user'}, $this->dataProvider->{'password'});
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $e)
        {
            echo "Error al Conectar: " . $e->getMessage();
        }
        return $connection;
    }

    public function setMaxConnections($max)
    {
        $this->maxConnections = $max;
    }

    function setMinConnections($min)
    {
        $this->minConnections = $min;
    }
}
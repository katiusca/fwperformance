<?php

namespace Mpwarfw\DBConnections;


abstract class GenericDAO extends DAO
{
    private $connectionPool;

    public function __construct()
    {
        $this->connectionPool = new BasicConnectionPool(1,20);
    }

    public function getAll()
    {
        $query 		= "SELECT * FROM ".$this->getTable();
        return self::executeQuery($query);
    }

    public function get($id)
    {
        $query = "SELECT * FROM ".$this->getTable()." where ".$this->getIdColumn()."=".$id;
        return self::executeQuery($query)[0];
    }

    public function executeQuery($query)
    {
        try
        {
            $conn = $this->connectionPool->getConnection();
            $statement 	= $conn->prepare($query);
            $statement->execute();
        }
        catch (\PDOException $exception)
        {
            echo "Error en Selecctionar: " . $exception->getMessage();
        }
        $row= $statement->fetchAll(\PDO::FETCH_ASSOC);
        $this->connectionPool->returnConnection($conn);
        return $row;
    }

    abstract public function  getTable();
    abstract public function  getIdColumn();
}
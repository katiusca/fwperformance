<?php

namespace Mpwarfw\Repository;

abstract class BasicRepository
{
    protected $dao;

    function getDao()
    {
        if($this->dao==null)
        {
            $this->dao = $this->createDao();
        }
        return $this->dao;
    }

    abstract public function createDao();

    public function getCacheDefinition($params, $method)
    {
        $parameters =['name'=> $method, 'params'=> implode(",",$params)];
        return $parameters;
    }
}
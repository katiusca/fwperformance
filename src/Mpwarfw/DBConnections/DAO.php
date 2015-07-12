<?php

namespace Mpwarfw\DBConnections;

abstract class DAO
{
    abstract public function __construct();
    abstract public function getAll();
    abstract public function get($id);
    abstract public function executeQuery($query);

}
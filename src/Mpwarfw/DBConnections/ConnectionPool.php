<?php

namespace Mpwarfw\DBConnections;

Interface ConnectionPool
{
    function getConnection();
    function setMaxConnections($max);
    function setMinConnections($min);
    function returnConnection($conn);
}
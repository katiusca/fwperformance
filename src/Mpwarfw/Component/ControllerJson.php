<?php

namespace Mpwarfw\Component;

use Mpwarfw\Utils\Request;
use Mpwarfw\Utils\ResponseJson;

abstract class ControllerJson
{
    public function build(Request $request, $action)
    {
        $result = $this->$action($request);
        $response=  new ResponseJson($result);
        return $response;
    }

    public function getCacheDefinition($param, $method)
    {
        $parameters =['name'=> __CLASS__, 'url'=>  implode(",",$param), 'method' => $method];
        return $parameters;
    }

}
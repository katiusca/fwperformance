<?php

namespace Mpwarfw\Component;

use Mpwarfw\Utils\Request;
use Mpwarfw\Utils\ResponseHttp;

abstract class Controller
{
    const STATUS_CODE = 200;

    public function build(Request $request, $action)
    {
        $result = $this->$action($request);
        $view = $this->getView();
        $content = $view->render($result);
        $response=  new ResponseHttp($content,self::STATUS_CODE);
        return $response;
    }

    public abstract function getView();

    public function getCacheDefinition($param, $method)
    {
        $parameters =['name'=> __CLASS__, 'url'=>  implode(",",$param), 'method' => $method];
        return $parameters;
    }

}
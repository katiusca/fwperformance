<?php

namespace Mpwarfw\Component;

use Mpwarfw\Cache\MemoryCache;
use Mpwarfw\Utils\Request;
use Mpwarfw\Utils\ResponseHttp;
use Mpwarfw\Utils\UriAnalyzer;

class Bootstrap
{
    private $mode;
    private $request;
    private $cache;

   public function __construct($mode,Request $request)
   {
       $this->mode= $mode;
       $this->request = $request;
       $this->cache = new MemoryCache();
   }

    public function execute()
    {
        $routing = new Routing();
        try
        {
            $cache = new MemoryCache();
            $route = $routing->getController($this->request->getUri());
            $controller_name = $route->{"controller"};
            $action = $route->{"action"};
            $controller = new $controller_name();
            $cache_params=$controller->getCacheDefinition(UriAnalyzer::getParameters($this->request->getUri()),$action);
            $content = $cache->get($cache_params);
            if(!$content)
            {
                $response = $controller->build($this->request, $action);
                $cache->set($cache_params, $response->getContent(), 1);
                return $response;
            }else
            {
                $response = new ResponseHttp($content);
                return $response;
            }

        }catch (\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}


<?php

namespace Mpwarfw\Component;

use Mpwarfw\Utils\UriAnalyzer;

class Routing
{
    const FILE_ROUTE= "../src/Config/routing.json";
    const MESSAGE= "The Route undefined";

    public function getController($url)
    {
        $routing_file = file_get_contents(self::FILE_ROUTE);
        $routing = json_decode($routing_file);
        if (!isset($routing->{UriAnalyzer::getController($url)})){

            throw new \Exception(self::MESSAGE);
        }
        return $routing->{UriAnalyzer::getController($url)};
    }

}
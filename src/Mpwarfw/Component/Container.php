<?php

namespace Mpwarfw\Component;

class Container
{
    private static $instance;
    const FILE_ROUTE = "../src/Config/containerService.json";

    public static function getInstance()
    {
        if (  !self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function getService($name)
    {
        $routing_file = file_get_contents(self::FILE_ROUTE);
        $routing = json_decode($routing_file);
        $service_mapping= $routing->{$name};
        $reflection_service = new \ReflectionClass($service_mapping->{"class"});
        $service = $reflection_service->newInstance();
        if(array_key_exists("references", $service_mapping)){
            foreach ($service_mapping->references as $key => $value) {
                if ($reflection_service->hasProperty($key)) {
                    $reflection_service->getProperty($key)->setValue($service, self::getService($value));
                }
            }
        }
        return $service;
    }

}
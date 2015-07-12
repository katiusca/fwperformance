<?php

namespace Mpwarfw\Cache;

abstract class Cache
{
	abstract public function set ($key, $content, $expiration);

	abstract public function get ($key);

	abstract public function delete ($key);

    public function getKeyName ($parameters)
    {
        $tempResult = '';
        array_change_key_case($parameters, CASE_LOWER);
        ksort($parameters, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($parameters as $key => $value)
        {
            if ( 'name' != $key && !empty($value))
            {
                $tempResult = $tempResult . $value;
            }
        }
        $tempResult = sha1($tempResult);
        $finalResult = strtolower($parameters['name']) . $tempResult;
        return $finalResult;
    }

}

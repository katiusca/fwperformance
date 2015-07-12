<?php

namespace Mpwarfw\Component;


class Validate
{
    private $parameters;

    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    public function getParams()
    {
        return $this->parameters;
    }

    function validateInput($key)
    {
       /* echo $this->parameters[$key];
        $data = stripslashes($this->parameters[$key]);
        echo $data;*/
        return htmlspecialchars($this->parameters[$key]);

    }

    public function checkInt($key)
    {
        if(array_key_exists($key, $this->parameters) && filter_var($this->parameters[$key], FILTER_SANITIZE_NUMBER_INT))
        {
            return $this->parameters[$key];
        }
        return null;
    }

    public function checkString($key)
    {
        if(array_key_exists($key, $this->parameters) && filter_var($this->parameters[$key], FILTER_SANITIZE_STRING))
        {
            return $this->parameters[$key];
        }
        throw new \Exception("Error en parametro");
    }

    public function checkEmail($key)
    {
        if (!filter_var($this->parameters[$key], FILTER_SANITIZE_EMAIL))
        {
            throw new \Exception("Error en email");
        }
        return $this->parameters[$key];
    }

    public function checkURL($key)
    {
        return $this->parameters[$key];
    }


}
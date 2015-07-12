<?php

namespace Mpwarfw\Utils;


class Session
{
    public function __construct()
    {
        session_start();
    }

    public function getValue($key)
    {
        if (!empty($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return false;
    }

    public function setValue($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
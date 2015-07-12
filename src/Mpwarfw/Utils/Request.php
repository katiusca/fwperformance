<?php

namespace Mpwarfw\Utils;

class Request
{
    protected $session;
    protected $method;
    protected $host;
    protected $uri;
    protected $server;
    protected $request;
    protected $file;
    protected $parameters_post;
    protected $parameters_get;

    function __construct(Session $session)
    {
        $this->session = $session;
        $this->method =  $_SERVER['REQUEST_METHOD'];
        $this->host =    $_SERVER['HTTP_HOST'];
        $this->uri =     $_SERVER['REQUEST_URI'];
        $this->server =  $_SERVER['SERVER_NAME'];
        $this->file =    $_FILES;
        $this->parameters_post =$_POST;
        $this->parameters_get = UriAnalyzer::getParameters($this->uri);
        $_GET = $_POST= $_SERVER= $_COOKIE = array();

    }

    public function getSession()
    {
        return $this->session;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function getParametersPost()
    {
        return $this->parameters_post;
    }

    public function getParametersGet()
    {
        return $this->parameters_get;
    }

}
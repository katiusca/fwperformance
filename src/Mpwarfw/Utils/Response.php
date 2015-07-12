<?php

namespace Mpwarfw\Utils;

abstract class Response
{
    protected $content;
    protected $statusCode;
    const STATUS_CODE = 200;

    public function __construct($content, $statusCode = self::STATUS_CODE)
    {
        $this->content =     $content;
        $this->statusCode =  $statusCode;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    abstract public function send();

}
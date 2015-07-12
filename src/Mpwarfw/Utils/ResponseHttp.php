<?php

namespace Mpwarfw\Utils;

class ResponseHttp  extends Response
{
    public function send()
    {
        if ($this->statusCode !== parent::STATUS_CODE)
        {
            header("HTTP/1.0 404 Not found");
        }else
        {
            header("HTTP/1.0 {$this->statusCode} ");
            echo $this->getContent();
        }
    }
}


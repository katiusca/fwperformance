<?php

namespace Mpwarfw\Utils;

class ResponseJson extends Response
{
    public function send()
    {
        header('Content-Type: application/json');
        echo "\n".json_encode($this->getContent());
    }

}
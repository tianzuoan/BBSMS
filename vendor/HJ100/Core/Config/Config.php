<?php

namespace HJ100\Core\Config;


//config http proxy

const ENABLE_HTTP_PROXY=false;

class Config
{
    private static $loaded = false;
    public static function load(){
        if(self::$loaded) {
            return;
        }
        EndpointConfig::load();
        self::$loaded = true;
    }
}
<?php
namespace Woo\App\Router;

class HttpHeader
{
    static function BearerToken()
    {
        return self::GetHeader();
    }

    protected static function GetHeader($name = 'Authorization')
    {
        $arr = getallheaders();
        if(!empty($arr[$name]))
        {
            $token = trim($arr[$name]);
            return str_replace('Bearer ','',$token);
        }
        return '';
    }
}

/*
curl -i -H "Authorization: Bearer token-123456" -H "Accept: application/json" -H "Content-Type: application/json" http://novo.xx
curl -H "Authorization: Bearer token-123456" -H "Accept: application/json" -H "Content-Type: application/json" http://novo.xx
curl -X GET
*/
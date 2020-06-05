<?php
namespace Woo\App\Router;

class HttpHeader
{
    static function BearerToken()
    {
        return trim(str_replace('Bearer', '', self::GetHeader()));
    }

    static function GetHeader($name = 'Authorization')
    {
        $arr = getallheaders();
        if(!empty($arr[$name]))
        {
            return $arr[$name];
        }
        return '';
    }
}

/*
curl -i -H "Authorization: Bearer token-123456" -H "Accept: application/json" -H "Content-Type: application/json" http://novo.xx
curl -H "Authorization: Bearer token-123456" -H "Accept: application/json" -H "Content-Type: application/json" http://novo.xx
curl -X GET
*/
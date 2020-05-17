<?php
namespace Woo\App\Email;

class EmailTheme
{
    static function Get($path, $data)
    {
        if(file_exists($path))
        {
            $txt = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.ltrim($path,'/'));
            return self::ReplaceTags($txt, $data);
        }
        else
        {
            return 'Email theme does not exists: ' .$path;
        }
    }

    static function ReplaceTags($html, $arr)
    {
        $h = $html;
        foreach ($arr as $k => $v)
        {
            $h = str_replace($k, $v, $h);
        }
        return $h;
    }
}
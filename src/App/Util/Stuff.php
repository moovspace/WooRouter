<?php
namespace Woo\App\Stuff;

class Stuff
{
    function CloseTags($html = '<h1>He <a href=""> llo </h1>')
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->encoding='UTF-8';
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        return $doc->saveHTML();
    }

    function ResponsiveImages($html='')
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $div = $dom->createElement('div');
        $div->setAttribute('class', 'responsive-img');
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image)
        {
            $new_div_clone = $div->cloneNode();
            $image->parentNode->replaceChild($new_div_clone,$image);
            $new_div_clone->appendChild($image);
        }
        return $dom->saveHTML();
    }

    function HtmlEntitiesToUtf8($html)
    {
        return mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
    }

    function PhpSlonik()
    {
        $str = chr(240) . chr(159) . chr(144) . chr(152);
        return $str;
    }
}
<?php
namespace Woo\App\Menu;

/**
 * Sub menu part
 */
class MenuBox
{
    // Top url
    public $Title = [];
    // Submenu
    public $All = [];
    // Open urls
    public $Urls = [];
    // Main url
    public $TitleUrl;

    function __construct($name, $url, $icon = '<i class="fas fa-radiation-alt"></i>', $open_urls = [])
    {
        // Open for urls
        foreach($open_urls as $u)
        {
            $this->Urls[] = $u;
        }
        $this->Urls[] = $url;
        $this->CurrUrl = $this->CurrUrl();

        $this->Title['name'] = $name;
        $this->Title['url'] = $url;
        $this->Title['icon'] = $icon;
    }

    function AddLink($name, $url, $icon = '<i class="fas fa-dot-circle"></i>')
    {
        $this->Urls[] = $url;
        $c = '';
        if($url == $this->CurrUrl)
        {
            $c = 'mlink-active';
        }
        $this->All[] = '<a href="'.$url.'" class="mlink '.$c.'"> <span>'.$icon.'</span> '.$name.'</a>';
    }

    function Show()
    {
        $sub = '';
        $open = '';
        $open_title = '';
        if(in_array($this->CurrUrl, $this->Urls))
        {
            $open = 'submenu-open';
            $open_title = 'title-open';
        }

        foreach($this->All as $k => $v)
        {
            $sub .= $v;
        }

        $Title = '<a href="'.$this->Title['url'].'" class="mlink '.$open_title.'"> <span>'.$this->Title['icon'].'</span> '.$this->Title['name'].'</a>';

        return '<div class="menu-box">'
                .$Title.
                '<div class="submenu '.$open.'">'
                    .$sub.
                '</div>
                </div>';
    }

    function CurrUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    function Style()
    {
        return '<style>
        .menu-box{
            float: left; width: 250px; overflow: hidden;
        }
        .menu-box .menu-opened{
            color: #ff6600;
        }
        .menu-box .submenu{
            display: none;
        }
        .menu-box .submenu-open{
            float: left; width: 100%; overflow: hidden;
            display: inherit;
            background: #efefef34;
            box-shadow: 0px 1px 3px rgba(0,0,0, 0.03) inset
        }
        .menu-box .mlink{
            float: left; width: 100%; text-decoration: none;
            padding: 10px;
            color: #258325;
        }
        .menu-box .mlink span i{
            padding: 0px 10px;
            color: #258325;
        }
        .menu-box .mlink:hover{
            background: rgba(213, 230, 213, 0.158);
        }
        .menu-box .mlink-active{
            color: #ff6600;
        }
        .menu-box .mlink-active span i{
            color: #ff6600;
        }
        .menu-box .mlink-active:hover{
            color: #f30
        }
        .title-open{
            border-left: 5px solid #258325;
        }
        .menu-box .submenu-open .mlink{
            padding-left: 15px;
        }
        </style>';
    }
}
/*
// How to
$m = new MenuBox('Panel', '/login', '<i class="fas fa-user"></i>');
$m->AddLink('Login', '/login');
$m->AddLink('Register', '/register');
echo $m->Show();
*/
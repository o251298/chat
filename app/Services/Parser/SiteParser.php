<?php


namespace App\Services\Parser;


class SiteParser
{
    public static function parse()
    {
        $url = "https://elle.ua/stil-zhizni/blog_stil_zhizni/zvorushliv-citati-pro-ukranu/";
        $content = file_get_contents($url);
        dd($content);
    }
}

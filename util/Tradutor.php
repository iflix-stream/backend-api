<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 29/08/2017
 * Time: 14:45
 */

namespace util;


class Tradutor
{

    private static function loadLanguage()
    {
        return strtolower(apache_request_headers()['Content-Language']) . ".json";
    }

    final static function do($index)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/language/" . self::loadLanguage())) {
            $lang = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/language/" . self::loadLanguage());
            $json_str = json_decode($lang, true);
            return $json_str[$index];
        }
        $lang = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/language/en-us.json");
        $json_str = json_decode($lang, true);
        return $json_str[$index];

    }
}

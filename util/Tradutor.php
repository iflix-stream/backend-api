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

        if (isset(apache_request_headers()['Content-Language'])) {
            return apache_request_headers()['Content-Language'] . ".json";
        }
        return "en-us.json";
    }

    final static function do($index)
    {
        if (file_exists("language/" . self::loadLanguage())) {
            $lang = file_get_contents("language/" . self::loadLanguage());
            $json_str = json_decode($lang, true);
            return $json_str[$index];
        }
        return false;
    }
}

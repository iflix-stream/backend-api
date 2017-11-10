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

//        if (isset(apache_request_headers()['Content-Language'])) {
//            return apache_request_headers()['Content-Language'] . ".json";
//        }
        return Settings::DEFAULT_LANGUAGE . ".json";
    }

    final static function do($index)
    {
        $langPadrao = file_get_contents(Settings::SERVER_PATH . "/language/" . Settings::DEFAULT_LANGUAGE . ".json");
        $jsonStrLangPadrao = json_decode($langPadrao, true);

        if (file_exists(Settings::SERVER_PATH . "/language/" . self::loadLanguage())) {
            $lang = file_get_contents(Settings::SERVER_PATH . "/language/" . self::loadLanguage());
            $jsonStrLang = json_decode($lang, true);


            if (isset($jsonStrLang[$index])) {
                return $jsonStrLang[$index];
            } else if (isset($jsonStrLang[$index])) {
                return $jsonStrLang[$index];
            }

            return $jsonStrLangPadrao[$index];

        }

        if (isset($jsonStrLangPadrao[$index])) {
            return $jsonStrLangPadrao[$index];
        }
        return "A index " . $index . " não foi implementada.";
    }
}

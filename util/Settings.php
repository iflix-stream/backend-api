<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 05/09/2017
 * Time: 08:23
 */

namespace util;


class Settings
{
    const DEFAULT_LANGUAGE = "pt-br";
    const URL_BASE_API = 'http://192.168.1.2/iflix/api';
    const URL_BASE_FRONT = 'http://192.168.1.2:8080';
    const SERVER_PATH = 'C:/xampp/htdocs/iFlix';

    static function load() {
        date_default_timezone_set('America/Sao_Paulo');
    }
}
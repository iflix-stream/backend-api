<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:06
 */

namespace util;
class HeaderWriter
{


    /**
     * HeaderWriter constructor.
     */
    public function __construct()
    {

        header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS;");
        header("X-Powered-By: iFlix-Api-Server;");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Headers: Authorization, Content-Type");
        header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
        header("Content-Type: application/json; charset=utf-8");
    }
}
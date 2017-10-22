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

        header("Content-type: application/json; charset=utf-8;");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT;");
        header("Access-Control-Allow-Origin: *");
    }
}
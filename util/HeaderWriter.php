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
     * @param string $params
     */
    public function __construct($params = "")
    {
        $headers = "Content-type: application/json; charset=utf-8";
        if ($params != "") {
            $headers .= "; " . $params;
        }

        header($headers);
    }
}
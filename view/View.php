<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 15:06
 */

namespace view;

use util\HeaderWriter;

class View extends HeaderWriter
{

    private static $headers;

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return self::$headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        self::$headers = $headers;
    }


    /**
     * @param array $data
     */
    public static final function render(array $data = [])
    {
        $headers = "Content-type: application/json; charset=utf-8; ";

        if (self::$headers != "") {
            $headers .= "; " . self::$headers;
        }
        header($headers);
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
        echo json_encode($data);
    }


}
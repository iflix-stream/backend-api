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

    public static final function render($data, $params = "")
    {
        $headers = "Content-type: application/json; charset=utf-8";
        if ($params != "") {
            $headers .= "; " . $params;
        }
        header($headers);
        echo json_encode($data);
    }
}
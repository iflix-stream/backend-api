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

    /**
     * @param array $data
     * @param string $params
     */
    public static final function render(array $data = [], $params = "")
    {
        $headers = "Content-type: application/json; charset=utf-8";
        if ($params != "") {
            $headers .= "; " . $params;
        }
        header($headers);
        echo json_encode($data);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 03/09/2017
 * Time: 22:14
 */

namespace util;


class DataConversor
{

    public function converter()
    {
        $data = "";
        $dataTipo = apache_request_headers()["Content-Type"];
        switch ($dataTipo) {
            case "application/x-www-form-urlencoded":
                $data = $_POST;
                break;
            case "application/json":
                $data = (array)json_decode(file_get_contents('php://input'));
                break;
            default:
                //colocar algo aki tipo pra manda pra view ou um die;
                break;
        }
        return $data;
    }
}
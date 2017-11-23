<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 03/09/2017
 * Time: 22:14
 */

namespace util;


use function GuzzleHttp\Psr7\parse_query;

class DataConversor
{

    public function converter()
    {
        $data = "";
        $dataTipo = isset(apache_request_headers()["Content-Type"]) ? apache_request_headers()["Content-Type"] : null;
        switch ($dataTipo) {
            case "application/x-www-form-urlencoded":
                $data = $_POST;
                if($_SERVER['REQUEST_METHOD'] == "PUT"){
                    $data = parse_query(file_get_contents('php://input'));
                }
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
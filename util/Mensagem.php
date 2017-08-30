<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 29/08/2017
 * Time: 14:39
 */

namespace util;

class Mensagem
{
//TODO: Fazer classe pra retornar os erros via array

    static function normal($index)
    {
        return [
            "type" => "normal",
            "message" => "" . Tradutor::do($index) . ""
        ];
    }

    static function error($index, $codigo = 0)
    {
        return [
            "type" => "error",
            "code" => $codigo,
            "message" => "" . Tradutor::do($index) . ""
        ];
    }

    static function warning($index, $codigo = 0)
    {
        return [
            "type" => "warning",
            "code" => $codigo,
            "message" => Tradutor::do($index)
        ];
    }

    static function success($index)
    {
        return [
            "type" => "success",
            "message" => Tradutor::do($index)
        ];
    }
}
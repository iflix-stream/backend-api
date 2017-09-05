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


    /**
     * @param $ref
     * @param bool $isTraduzir
     * @return array
     */
    function normal($ref, $isTraduzir = true)
    {
        if ($isTraduzir) {
            return [
                "type" => "normal",
                "message" => "" . Tradutor::do($ref) . ""
            ];
        }
        return [
            "type" => "normal",
            "message" => "" . $ref . ""
        ];

    }

    /**
     * @param $ref
     * @param int $codigo
     * @param bool $isTraduzir
     * @return array
     */
    function error($ref, $codigo = 0, $isTraduzir = true)
    {
        if ($isTraduzir) {
            return [
                "type" => "error",
                "code" => $codigo,
                "message" => "" . Tradutor::do($ref) . ""
            ];
        }
        return [
            "type" => "error",
            "code" => $codigo,
            "message" => "" . $ref . ""
        ];
    }

    /**
     * @param $ref
     * @param int $codigo
     * @param bool $isTraduzir
     * @return array
     */
    function warning($ref, $codigo = 0, $isTraduzir = true)
    {
        if ($isTraduzir) {
            return [
                "type" => "warning",
                "code" => $codigo,
                "message" => Tradutor::do($ref)
            ];
        }
        return [
            "type" => "warning",
            "code" => $codigo,
            "message" => $ref
        ];
    }

    /**
     * @param $ref
     * @param bool $isTraduzir
     * @return array
     */
    function success($ref, $isTraduzir = true)
    {
        if ($isTraduzir) {
            return [
                "type" => "success",
                "message" => Tradutor::do($ref)
            ];
        }
        return [
            "type" => "success",
            "message" => $ref
        ];
    }
}
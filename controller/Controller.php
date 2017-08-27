<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 18:02
 */

namespace controller;


interface Controller
{
    static function post();
    static function get($params = []);
    static function put();
    static function delete();
}
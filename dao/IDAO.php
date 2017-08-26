<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:11
 */

namespace dao;


interface IDAO
{
    static function create($video);
    static function retreave($video);
    static function update($video);
    static function delede($video);
}
<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:11
 */

namespace model\dao;


interface IDAO
{
    /**
     * @param $object
     * @return mixed
     */
    static function create($object);

    /**
     * @param $object
     * @return mixed
     */
    static function retreave($object);

    /**
     * @param $object
     * @return mixed
     */
    static function update($object);

    /**
     * @param $object
     * @return mixed
     */
    static function delete($object);
}
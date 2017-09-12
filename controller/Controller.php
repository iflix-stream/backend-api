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
    public function post();

    public function get($params = []);

    public function put($params = []);

    public function delete($params = []);
}
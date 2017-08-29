<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 29/08/2017
 * Time: 14:08
 */

namespace tests;
include '../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use util\Api;

class TesteAPI extends TestCase
{
    function testRodarPost()
    {
        $url = "localhost/iFlix/api/video/id/1";
        $_SERVER['REQUEST_METHOD'] = "GET";

        $this->assertEquals(1, new Api($url));
    }
}

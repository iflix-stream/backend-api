<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 16:25
 */

namespace dao;


use phiber\Phiber;

class VideoDAO
{
    public static function create($obj)
    {
        $criteria = new Phiber();
        $phiber = $criteria->openPersist($obj);
        $phiber->create();
        echo $phiber->show();
    }

    public function retreave()
    {

    }
}
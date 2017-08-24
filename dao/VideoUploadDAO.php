<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/08/2017
 * Time: 13:44
 */

namespace dao;

use model\VideoUpload;
use phiber\Phiber;

class VideoUploadDAO
{
    public static function create($obj)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($obj);
        $criteria->create();
        echo $criteria->show();
    }
}
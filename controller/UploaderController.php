<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 20/11/2017
 * Time: 11:05
 */

namespace controller;


use model\Video;
use util\DataConversor;
use view\View;

class UploaderController implements IController
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $video = new Video();
        $video->setId($_POST['id']);
        $video->setTipo($_POST['tipo']);
        $video->fazerUpload($_FILES['file']);
    }

    public function get($params = [])
    {
        // TODO: Implement get() method.
    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        // TODO: Implement delete() method.
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 23/11/2017
 * Time: 09:25
 */

namespace controller;


use model\Avatar;
use view\View;

class AvatarController implements IController
{

    public function post()
    {
        // TODO: Implement post() method.
    }

    /**
     * @param array $params
     */
    public function get($params = [])
    {
        (new View())::render((new Avatar())->listar());
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
<?php
/**
 * Created by PhpStorm.
 * User: ifgoianoadmin
 * Date: 29/08/2017
 * Time: 20:16
 */

use view\View;

include_once '../vendor/autoload.php';
View::render(\util\Mensagem::normal("welcome"));


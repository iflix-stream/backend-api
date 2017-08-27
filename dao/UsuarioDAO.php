<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:10
 */

namespace dao;


use model\Usuario;
use phiber\Phiber;


class UsuarioDAO implements IDAO
{
    private $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    static function create($usuario)
    {
        // TODO: Implement create() method.
    }

    static function retreave($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        if ($usuario->getId() != null) {

            $restrictionID = $criteria->restrictions()->equals("id", $usuario->getId());
            $restrictionAtivado = $criteria->restrictions()->equals("ativado", '1');
            $restrictionAtivadoID = $criteria->restrictions()->and($restrictionAtivado, $restrictionID);
            $criteria->add($restrictionAtivadoID);
            $criteria->select();
            return $criteria->show();
        }
        return "Parametro ID nulo.";
    }

    static function update($usuario)
    {
        // TODO: Implement update() method.
    }

    static function delede($usuario)
    {
        // TODO: Implement delede() method.
    }


}
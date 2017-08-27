<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:10
 */

namespace dao;


use model\Usuario;

class UsuarioDAO implements IDAO
{
    private $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    static function create($video)
    {
        // TODO: Implement create() method.
    }

    static function retreave($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        if ($video->getId() != null) {

            $restrictionID = $criteria->restrictions()->equals("id", $video->getId());
            $restrictionAtivado = $criteria->restrictions()->equals("ativado", '1');
            $restrictionAtivadoID = $criteria->restrictions()->and($restrictionAtivado, $restrictionID);
            $criteria->add($restrictionAtivadoID);
            $criteria->select();
            return $criteria->show();
        }
        return "Parametro ID nulo.";
    }

    static function update($video)
    {
        // TODO: Implement update() method.
    }

    static function delede($video)
    {
        // TODO: Implement delede() method.
    }


}
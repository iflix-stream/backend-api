<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 20/10/2017
 * Time: 20:50
 */

namespace model\dao;

use phiber\Phiber;

class ContagemDAO implements IDAO
{


    static function create($video)
    {
        var_dump($video);
        $phiber = new Phiber();
        $phiber->writeSQL('INSERT INTO assistindo_filme(filme_id,usuario_id,horario_play) VALUES (:filmeId,:usuarioId,:horarioPlay)');
        $phiber->bindValue("filmeId", $video['filmeId']);
        $phiber->bindValue("usuarioId", $video['usuarioId']);
        $phiber->bindValue("horarioPlay", $video['horarioPlay']);
        $phiber->execute();
    }

    static function retreave($video)
    {
        // TODO: Implement retreave() method.
    }

    static function update($video)
    {
        // TODO: Implement update() method.
    }

    static function delete($video)
    {
        // TODO: Implement delete() method.
    }
}
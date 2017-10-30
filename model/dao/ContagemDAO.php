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
        $phiber = new Phiber();
        if ($video['tipo'] == 'filme') {
            $phiber->writeSQL('INSERT INTO assistindo_filme(filme_id,usuario_id) VALUES (:id,:usuarioId)');
            $phiber->bindValue("id", $video['id']);
            $phiber->bindValue("usuarioId", $video['usuarioId']);
        } else if ($video['tipo'] == 'serie') {
            $phiber->writeSQL('INSERT INTO assistindo_serie(episodio_id,usuario_id) VALUES (:id,:usuarioId)');
            $phiber->bindValue("id", $video['id']);
            $phiber->bindValue("usuarioId", $video['usuarioId']);
        }
        $phiber->execute();
    }

    static function retreave($video)
    {
        if (!isset($video['permicao'])) {
            $contagem = 0;
            $phiber = new Phiber();
            $phiber->setTable('assistindo_serie');
            $phiber->select();
            $contagem += $phiber->rowCount();
            $phiber = new Phiber();
            $phiber->setTable('assistindo_filme');
            $phiber->select();
            $contagem += $phiber->rowCount();
            echo $contagem;

        } else {
            //filme
            $phiber = new Phiber();
            $phiber->setTable('assistindo_filme');
            $array = $phiber->select();
            for ($i = 0; $i < count($array); $i++) {
                $timestamp = strtotime($array[$i]['horario_play']);
                $phiber = new Phiber();
                $restrictionID = $phiber->restrictions->equals("id", $array[$i]['filme_id']);
                $phiber->setTable('filme');
                $phiber->setFields(['duracao']);
                $phiber->add($restrictionID);
                $array2 = $phiber->select();
                $horario = $array2[0]['duracao'];
                $segundos = strtotime('1970-01-01 ' . $horario . 'UTC');
                if (($timestamp + $segundos) - time() < 0) {
                    $phiber = new Phiber();
                    $phiber->writeSQL('DELETE FROM assistindo_filme WHERE idassistindo_filme=' . $array[$i]["idassistindo_filme"]);
                    $phiber->execute();
                }

            }
            //serie
            $phiber = new Phiber();
            $phiber->setTable('assistindo_serie');
            $array = $phiber->select();
            for ($i = 0; $i < count($array); $i++) {
                $timestamp = strtotime($array[$i]['horario_play']);
                $phiber = new Phiber();
                $restrictionID = $phiber->restrictions->equals("id", $array[$i]['episodio_id']);
                $phiber->setTable('episodio');
                $phiber->setFields(['duracao']);
                $phiber->add($restrictionID);
                $array2 = $phiber->select();
                $horario = $array2[0]['duracao'];
                $segundos = strtotime('1970-01-01 ' . $horario . 'UTC');
                if (($timestamp + $segundos) - time() < 0) {
                    $phiber = new Phiber();
                    $phiber->writeSQL('DELETE FROM assistindo_serie WHERE idassistindo_serie=' . $array[$i]["idassistindo_serie"]);
                    $phiber->execute();
                }
            }
        }
    }

    static function update($video)
    {
        // TODO: Implement update() method.
    }

    static function delete($video)
    {
        $phiber = new Phiber();
        $phiber->writeSQL('DELETE FROM assistindo_filme WHERE (:usuarioId);DELETE FROM assistindo_serie WHERE (:usuarioId)');
        $phiber->bindValue("usuarioId", $video['usuarioId']);
        return $phiber->execute();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 07/09/2017
 * Time: 19:10
 */

use phiber\Phiber;

include_once '../vendor/autoload.php';
$phiber = new Phiber();

$phiber->setTable("usuario");
$phiber->setFields(["id","nome","email"]);
$phiber->add($phiber->restrictions->join("usuario_endereco", ["pk_usuario", "fk_usuario"]));
$phiber->add($phiber->restrictions->join("fornecedor_endereco", ["pk_usuario", "fk_usuario"],"LEFT"));
$phiber->add($phiber->restrictions->and($phiber->restrictions->equals("ip","1"), $phiber->restrictions->equals("nome","marcio") ));
$phiber->add($phiber->restrictions->limit(15));
$phiber->add($phiber->restrictions->offset(5));
$phiber->add($phiber->restrictions->orderBy(['id ASC']));
$phiber->select();
echo $phiber->show();
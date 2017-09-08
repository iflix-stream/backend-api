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

$phiber->setTable("user");
$phiber->setFields(["user.id","user.name","user.email"]);
$phiber->add($phiber->restrictions->join("user_address", ["pk_user", "fk_user"]));
$phiber->add($phiber->restrictions->and($phiber->restrictions->equals("user.id","1"), $phiber->restrictions->like("user.name","Marcio") ));
$phiber->add($phiber->restrictions->limit(15));
$phiber->add($phiber->restrictions->offset(5));
$phiber->add($phiber->restrictions->orderBy(['user.id ASC']));
$phiber->select();
echo $phiber->show();

// PRINTS

//SELECT id, nome, email FROM usuario
// INNER JOIN usuario_endereco
// ON pk_usuario = fk_usuario
//  LEFT JOIN fornecedor_endereco ON pk_usuario = fk_usuario
//  WHERE (ip = :condition_ip AND nome = :condition_nome)
// ORDER BY id ASC LIMIT 15  OFFSET 5;
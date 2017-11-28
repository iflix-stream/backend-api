<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/11/2017
 * Time: 21:22
 */
include '../../vendor/autoload.php';
//Instalar o FFMPeg no servidor
$video = new \model\Video();
$filme = new \model\Filme();
$filme->setId(1);
$filme->setDuracao(6605);
$filme->processar();

$filme->setId(2);
$filme->setDuracao(6144);
$filme->processar();

$filme->setId(3);
$filme->setDuracao(7877);
$filme->processar();

$filme->setId(4);
$filme->setDuracao(8146);
$filme->processar();

$filme->setId(5);
$filme->setDuracao(7223);
$filme->processar();

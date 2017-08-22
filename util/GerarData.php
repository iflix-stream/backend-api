<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 22/08/2017
 * Time: 09:10
 */

namespace util;


class GerarData
{
    function gerarDataHora(){
        $hr = date("H:i:s", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        $dia = date("d", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        $mês = date("n", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        $ano = date("Y", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        $dia_sem = date("w", mktime(gmdate("H")-3, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        $meses = array( 1=> "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $semanas = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");
        //echo " $dia/ $meses[$mês] /$ano $hr";
        //echo "$ano/$meses[$mês]/$dia $hr";
        $anoDataHoraSegundo =   "$ano/$meses[$mês]/$dia $hr";
        return $anoDataHoraSegundo;
    }
}
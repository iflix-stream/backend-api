<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 14:30
 */

namespace util;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class Token
{
    function tokenVazio()
    {
        if (isset(apache_request_headers()["Authorization"])) {// Pega o token do cabeçalho) {//verifica se o cabeçãlho com a authorization esta vazio
            return true;
        } else {
            return false;
        }
    }
    function recebeToken()
    {
        return apache_request_headers()["Authorization"];// Pega o token do cabeçalho
    }
    function validaToken($token)
    {
        try {
            $parser = new Parser();
            $oToken = $parser->parse($token);
            $signer = new Sha256();//define a assinatura da chave
            $expirado = $oToken->isExpired();
            $tokenValido = $oToken->verify($signer, 'chave'); // onde contem a chave e é verificado o token
            if ($expirado == false && $tokenValido == true) {
                return true;// retorna true quando o token estiver valido e com sua validade
            } else {
                return false; // retorna false se o token nao for valido ou a validade estiver expirada
            }
        } catch (Exception $e) {
            return false;
        }
    }
    function verificaPermicao($token)
    {
        $parser = new Parser();
        $oToken = $parser->parse($token);
        $permicao = $oToken->getClaim('Permicao');
        return $permicao;
    }
    function token()
    {
        if (ValidaToken::tokenVazio()) {//verifica se o cabeçãlho com a authorization esta vazio
            $token = ValidaToken::recebeToken();
            $tokenValido = ValidaToken::validaToken($token);//Verifica se token e valido
            if ($tokenValido) {
                $permicao = ValidaToken::verificaPermicao($token);// recebe um array de permicoes
                return $permicao;
            } else {
                header('HTTP/1.0 400 Token Invalido');
                die();
            }
        }
        else{
            header('HTTP/1.0 401 Não Autorizado');
            die();
        }
    }
    function gerarToken($permicao,$nome)
    {
        $signer = new Sha256();
        $token = (new Builder())->setIssuer('api.garage')// Configures the issuer (iss claim)
        ->setAudience('api.garage')// Configures the audience (aud claim)
        ->setId('123apigarage456', true)// Configura o id (jti claim), replicating as a header item
        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60)// Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 3600)// Configura a data de expiração do token
        ->set('Permicao', $permicao)// Define a permicao para o sistema
        ->set('Nome', $nome['nome'])//Define o nome do usuario
        ->set('Email',$nome['email'])//Define o emails
        ->set('Avatar',$nome['avatar'])//Define o emails
        ->sign($signer, 'chave')// cria uma chave de assinatura privada
        ->getToken(); // Recupera o token
        return $token;
    }
}
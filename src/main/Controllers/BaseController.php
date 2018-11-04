<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use App\Models\Usuario;
use App\Configs\EnvConfig;
use App\Configs\MiddlewaresConfig;
use App\Configs\IlluminateDBConfig;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController {

  const AUTHORIZATION = 'Authorization';
  const BEARER_WITH_SPACE = 'Bearer ';

  private $dbConn;

  public function __construct(){
    $this->dbConn = (new IlluminateDBConfig())->getIlluminateConnection();
  }

  public function getDBConnection(){
    return $this->dbConn;
  }

  public function getPDO(){
    return $this->getDBConnection()->getPdo();
  }

  protected function getIdUserCurrent(Request $request){
    $idUsuarioLogado = $request->getAttribute(MiddlewaresConfig::JWT_ATTRIBUTE_GET);
    if(empty($idUsuarioLogado)){
      throw new \Exception('Usuário não está logado! Logue e tente novamente', 401);
    }
    return $idUsuarioLogado[0];
  }

  protected function getUserCurrent(Request $request){
    $user = Usuario::find($this->getIdUserCurrent($request));
    return $user;
  }

  protected function extraiToken(Request $request){
    $headerValueArray = $request->getHeader(self::AUTHORIZATION);
    if(empty($headerValueArray)){
        throw new \Exception('Acesso não autorizado!', 401);
    }
    $token = substr($headerValueArray[0], 7, strlen($headerValueArray[0]));
    $idUsuarioLogado = JWT::decode($token, getenv(EnvConfig::JWT_SECRET), array(getenv(EnvConfig::JWT_HASH)));
    return $idUsuarioLogado;
}
}
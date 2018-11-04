<?php

namespace App\Controllers;

use App\Configs\EnvConfig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SystemController {

  const METHOD_STATUS_SISTEMA = self::class . ':getStatusSistema';
  const METHOD_VERSAO_SISTEMA = self::class . ':getVersaoSistema';
  const MSG = '<h1>Estamos no ar :)</h1>';
  const MSG_PARAM = '<h3>Parâmetros: %s </h3>';

  public function getStatusSistema(Request $request, Response $response){
      $name = $request->getQueryParam('p');
      if(!empty($name))
          return $response->write(self::MSG .  sprintf(self::MSG_PARAM, $name));
      return $response->write(self::MSG);
  }

  public function getVersaoSistema(Request $request, Response $response){
    return $response->withJson(['version' => getenv(EnvConfig::VERSION_SYS)]);
  }

}
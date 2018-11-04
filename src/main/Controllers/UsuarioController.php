<?php
namespace App\Controllers;

use App\Models\Usuario;
use App\Helpers\Mensagem;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsuarioController extends BaseController {

  const METHOD_CADASTRAR = self::class . ':cadastrar';

  public function cadastar(Request $request, Response $response) {
    if($request->getAttribute('has_errors')) {
      $erros = Mensagem::criarMensagens($request->getAttribute('errors'), SettingsConfig::STATUS_WARNING);
      return $response->withStatus(400)->withJson($erros);
    }
    try{
      $this->getPDO()->beginTransaction();
      $json = $request->getParsedBody();
      Usuario::create($json);
      return $response->withStatus(201);
    }catch(\Exception $exc){
      $this->getPDO()->rollback();
      $erros = Mensagem::criarMensagem($exc->getMessage());
      return $response->withStatus(502)->withJson($erros);
    }
  }
}
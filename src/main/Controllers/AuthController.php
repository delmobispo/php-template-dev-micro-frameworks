<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use App\Models\Usuario;
use App\Helpers\Mensagem;
use App\Configs\EnvConfig;
use App\Helpers\StringHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends BaseController{

    const METHOD_LOGAR = self::class .  ':logar';
    const METHOD_BUSCAR_USUARIO_TOKEN = self::class . ':buscarUsuarioPorToken';
    const METHOD_VALIDA_TOKEN = self::class . ':validarToken';

    public function logar(Request $request, Response $response){
        if($request->getAttribute('has_errors')){
            $erros = Mensagem::criarMensagens($request->getAttribute('errors'), SettingsConfig::STATUS_WARNING);
            return $response->withStatus(400)->withJson($erros);
        }
        $json = $request->getParsedBody();
        $usuario = Usuario::where('login', $json['login'])->first();
        if(empty($usuario) || !password_verify($json['senha'], $usuario->senha)){
            $erros = Mensagem::criarMensagem('Acesso não autorizado! Login ou senha inválidos.', SettingsConfig::STATUS_WARNING);
            return $response->withStatus(401)->withJson($erros);
        }

        $tokenObject = [

        ];
        JWT::$leeway = 60;
        $jwt = JWT::encode($tokenObject, getenv(EnvConfig::JWT_SECRET));
        return $response->withHeader(self::AUTHORIZATION, self::BEARER_WITH_SPACE . $jwt)
            ->withJson(['token' => $jwt]);
    }

    public function buscarUsuarioPorToken(Request $request, Response $response){
        $usuarioCompleto = $this->getUserCurrent($request);
        return $response->withJson($usuarioCompleto);
    }

    public function validarToken(Request $request, Response $response){
        $this->extraiToken($request);
        return $response->withJson([]);
    }
}
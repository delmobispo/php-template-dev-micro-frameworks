<?php
namespace App\Configs;

use App\Validators\AuthValidator;
use App\Controllers\AuthController;
use App\Validators\UsuarioValidator;
use App\Controllers\SystemController;
use App\Controllers\UsuarioController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class RoutesConfig{

    const ROOT = '/';
    const ADMIN = '/admin';
    const BASIC = '/basic';
    const VERSION = '/version';
    const USUARIO = '/admin/usuario';
    const AUTH = '/admin/auth';
    const AUTH_LOGOUT = '/admin/auth/logout';
    const AUTH_USUARIO = '/admin/auth/usuario';
    const AUTH_REFRESH = '/admin/auth/refresh';

    public function __construct($app){
        $app->get(self::ROOT, SystemController::METHOD_STATUS_SISTEMA);
        $app->get(self::VERSION, SystemController::METHOD_VERSAO_SISTEMA);
        $app->put(self::USUARIO, UsuarioController::METHOD_ATUALIZA)->add(UsuarioValidator::get());
        $app->post(self::AUTH, AuthController::METHOD_LOGAR)->add(AuthValidator::get());
        $app->post(self::AUTH_LOGOUT, AuthController::METHOD_VALIDA_TOKEN);
        $app->get(self::AUTH_USUARIO, AuthController::METHOD_BUSCAR_USUARIO_TOKEN);
        $app->get(self::AUTH_REFRESH, AuthController::METHOD_VALIDA_TOKEN);
    }
}

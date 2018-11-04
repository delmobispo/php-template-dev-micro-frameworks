<?php
namespace App\Configs;

use App\Controllers\AuthController;
use App\Controllers\SystemController;
use App\Controllers\UsuarioController;

class ControllersConfig{

    public function __construct($container){

        $container[SystemController::class] = function(){
            return new SystemController();
        };

        $container[UsuarioController::class] = function(){
            return new UsuarioController();
        };

        $container[AuthController::class] = function(){
            return new AuthController();
        };

    }

}
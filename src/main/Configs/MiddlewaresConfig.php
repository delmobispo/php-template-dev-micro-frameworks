<?php

namespace App\Configs;

use App\Helpers\Mensagem;
use App\Configs\EnvConfig;
use App\Configs\RoutesConfig;
use Tuupola\Middleware\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;
use Tuupola\Middleware\JwtAuthentication\RequestPathRule;
use Tuupola\Middleware\JwtAuthentication\RequestMethodRule;

class MiddlewaresConfig{

    const JWT_ATTRIBUTE_GET = 'jwt';

    public function __construct($app){        
        $this->initJWT($app);
        $this->initCORS($app);
    }

    private function initCORS($app){
        $app->add(new CorsMiddleware([
            "origin" => getenv(EnvConfig::CORS_ORIGIN),
            "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE", "OPTIONS"],
            "headers.allow" => ['Access-Control-Allow-Headers', 'X-Requested-With', 'Content-Type', 'Accept', 'Origin', 'Authorization'],
            "headers.expose" => ['Access-Control-Allow-Headers', 'X-Requested-With', 'Content-Type', 'Accept', 'Origin', 'Authorization'],
            "credentials" => true,
            "cache" => 86400,
            "error" => function ($request, $response, $arguments) {
                $data = Mensagem::criarMensagem($arguments["message"]);
                return $response
                    ->withHeader("Content-Type", "application/json")
                    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
        ]));
    }

    private function initJWT($app){
        $app->add(new JwtAuthentication([
            "rules" => [
                new RequestPathRule([
                    "path" => [RoutesConfig::ADMIN],
                    "ignore" => [RoutesConfig::AUTH, RoutesConfig::VERSION]
                ]),
                new RequestMethodRule([
                    "ignore" => ["OPTIONS"]
                ])
            ],
            "attribute" => self::JWT_ATTRIBUTE_GET,
            "realm" => "Protected", 
            "secret" => getenv(EnvConfig::JWT_SECRET),
            "error" => function ($response, $arguments) {
                $data = Mensagem::criarMensagem($arguments["message"]);
                return $response
                    ->withHeader("Content-Type", "application/json")
                    ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
        ]));
    }
}
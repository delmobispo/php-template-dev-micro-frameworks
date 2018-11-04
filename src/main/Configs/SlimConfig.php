<?php
namespace App\Configs;

use Slim\App;
use Slim\Container;
use App\Helpers\Mensagem;
use App\Configs\EnvConfig;
use App\Configs\IlluminateDBConfig;

class SlimConfig{

    private $app;
    private $container;

    public function __construct(){
        new EnvConfig();
        new IlluminateDBConfig();
        $this->initSlim();
        $this->initErrorHandle();
        $this->initPHPErrorHandle();
        $this->initNotAllowedHandle();
        $this->initNotFoundHandler();
    }

    public function getApp(){
        return $this->app;
    }

    public function getContainer(){
        return $this->container;
    }

    private function initNotFoundHandler(){
        $this->container['notFoundHandler'] = function ($c) {
            return function ($request, $response) use ($c) {
                $msg = Mensagem::criarMensagem('O recurso solicitado não existe!');
                return $c['response']
                    ->withStatus(404)
                    ->withJson($msg);
            };
        };
    }

    private function initNotAllowedHandle(){
        $this->container['notAllowedHandler'] = function ($c) {
            return function ($request, $response, $methods) use ($c) {
                $msg = Mensagem::criarMensagem("Chamada ao método não permitido. Método deve ser: " . implode(', ', $methods));
                return $c['response']
                    ->withStatus(405)
                    ->withHeader('Allow', implode(', ', $methods))
                    ->withHeader("Access-Control-Allow-Methods", implode(",", $methods))
                    ->withJson($msg);
            };
        };
    }

    private function initPHPErrorHandle(){
        $this->container['phpErrorHandler'] = function ($c) {
            return function ($request, $response, $error) use ($c) {
                $msg = Mensagem::criarMensagem($error);
                return $c['response']->withStatus(500)->withJson($msg);
            };
        };
    }

    private function initErrorHandle(){
        $this->container['errorHandler'] = function ($c) {
            return function ($request, $response, $exception) use ($c) {
                $statusCode = $exception->getCode();
                if (!is_integer($statusCode) || $statusCode<100 || $statusCode>599) {
                  $statusCode = 500;
                }
                $msg = Mensagem::criarMensagem($exception->getMessage());
                return $c['response']
                    ->withStatus($statusCode)
                    ->withJson($exception);
            };
        };
    }

    private function initSlim(){
        $settings = [
            'settings' => [
                // Slim Settings
                'determineRouteBeforeAppMiddleware' => true,
                'displayErrorDetails' => getenv(EnvConfig::DEV_MODE),
                //'db' => $db
            ],
        ];
        $this->container = new Container($settings);
        $this->app = new App($this->container);
        //$this->container = $this->app->getContainer();
    }
}

?>

<?php
namespace App\Test\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use App\Configs\RoutesConfig;
use PHPUnit\Framework\TestCase;
use App\Controllers\SystemController;

class SystemControllerTest extends TestCase{

    private $controller;

    public function setUp(){
        $this->controller = new SystemController();
    }

    public function test_getStatusSistema(){
        $environment = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => RoutesConfig::ROOT,
        ]);
        $request = Request::createFromEnvironment($environment);
        $response = new Response();
        $response = $this->controller->getStatusSistema($request, $response);
        $this->assertSame((string)$response->getBody(), SystemController::MSG);
    }

    public function test_getStatusSistemaComParametro(){
        $controller = new SystemController();
        $p = 'test';
        $environment = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => RoutesConfig::ROOT,
            'QUERY_STRING'=>'p=' . $p
        ]);
        $request = Request::createFromEnvironment($environment);
        $response = new Response();
        $response = $this->controller->getStatusSistema($request, $response);
        $this->assertSame((string)$response->getBody(), SystemController::MSG . sprintf(SystemController::MSG_PARAM, $p));
    }

    public function test_getVersaoSistema(){
        $controller = new SystemController();
        $environment = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => RoutesConfig::VERSION,
        ]);
        $request = Request::createFromEnvironment($environment);
        $response = new Response();
        $response = $this->controller->getVersaoSistema($request, $response);
        $this->assertSame((string)$response->getBody(), sprintf('{"version":"%s"}', '1.0.0-SNAPSHOT'));
    }
}
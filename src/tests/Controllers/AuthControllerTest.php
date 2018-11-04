<?php

namespace App\Test\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use App\Configs\RoutesConfig;
use PHPUnit\Framework\TestCase;
use App\Controllers\AuthController;
use App\Test\Config\DatabaseTestCase;

class AuthControllerTest extends DatabaseTestCase{

    private $controller;

    public function setUp(){
        parent::setUp();
        $this->controller = new AuthController();
    }

    public function test_logar(){
        $environment = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => RoutesConfig::AUTH,
        ]);
        $request = Request::createFromEnvironment($environment);
        $request->withParsedBody([
            'login' => 'delmo.xsalada@gmail.com',
            'senha' => '1234'
        ]);
        $response = new Response();
        $response = $this->controller->logar($request, $response);
        $this->assertEquals($response->getStatusCode(), 401);
    }

}
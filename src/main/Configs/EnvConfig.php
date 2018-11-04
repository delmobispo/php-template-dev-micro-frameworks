<?php

namespace App\Configs;
use Dotenv\Dotenv;

class EnvConfig {
  const DRIVER          = 'DRIVER';
  const DB_HOST         = 'DB_HOST';
  const DB_NAME         = 'DB_NAME';
  const DB_USER         = 'DB_USER';
  const DB_PASSWORD     = 'DB_PASSWORD';
  const DB_CHARSET      = 'DB_CHARSET';
  const DB_COLLACTION   = 'DB_COLLACTION';
  const DB_PREFFIX      = 'DB_PREFFIX';
  const DEV_MODE        = 'DEV_MODE';
  const JWT_SECRET      = 'JWT_SECRET';
  const JWT_HASH        = 'JWT_HASH';
  const CORS_ORIGIN     = 'CORS_ORIGIN';
  const DATE_TIMEZONE   = 'DATE_TIMEZONE';
  const VERSION_SYS     = 'VERSION_SYS';

  private $dotenv;

  public function __construct(){
    $this->dotenv = new Dotenv(__DIR__);
    $this->dotenv->load();
  }
}
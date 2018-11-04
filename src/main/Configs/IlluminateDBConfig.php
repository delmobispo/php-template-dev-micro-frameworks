<?php

namespace App\Configs;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Connectors\ConnectionFactory;

class IlluminateDBConfig{  

    /**
     * Object Variables
     */
    private $capsule;
        
    /**
     * Constructor
     * 
     */
    public function __construct(){       

        $this->capsule = new Manager();

        $this->capsule->addConnection(self::getIlluminateSettings());

        // Set the event dispatcher used by Eloquent models... (optional)
        $container = new Container();
        $dispacher = new Dispatcher($container);
        $this->capsule->setEventDispatcher($dispacher);

        // Set the cache manager instance used by connections... (optional)
        //$this->capsule->setCacheManager(...);

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
        
    }
    
    /**
     * Illuminate Connection and Bootup
     * 
     * @return \Illuminate\Database\Connection Illuminate Connection Object
     */
    public function getIlluminateConnection(){
        
        return $this->capsule->getConnection();

    }

    /**
     * getIlluminateSettings
     * 
     * @return String[] Connection information
     */
    static function getIlluminateSettings(){
        $db = array(
            'driver'    => getenv(EnvConfig::DRIVER),
            'host'      => getenv(EnvConfig::DB_HOST),
            'database'  => getenv(EnvConfig::DB_NAME),
            'username'  => getenv(EnvConfig::DB_USER),
            'password'  => getenv(EnvConfig::DB_PASSWORD),
            'collation' => getenv(EnvConfig::DB_COLLACTION),
            'charset'   => getenv(EnvConfig::DB_CHARSET),
            'prefix'    => getenv(EnvConfig::DB_PREFFIX),
        );
        return $db;

    }
    
}
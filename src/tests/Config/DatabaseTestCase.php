<?php
namespace App\Test\Config;

use Phinx\Config\Config;
use Phinx\Migration\Manager;
use PHPUnit\Framework\TestCase;
use App\Configs\IlluminateDBConfig;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseTestCase extends TestCase {

    public function setUp () {
        $env = 'testing';
        $config = Config::fromYaml(__DIR__ . '../../../phinx.yml');
        $migrationManager = new Manager($config, new ArgvInput(), new ConsoleOutput());
        $migrationManager->getEnvironment($env);
        $migrationManager->migrate($env);
        $migrationManager->seed($env);
    }

}
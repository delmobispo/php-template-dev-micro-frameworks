<?php
namespace App\Test\Helpers;

use App\Helpers\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase{

    public function test_getSomenteNumeros(){
        $result = '1234';
        $alpha = '1ud2u%3o4j';
        $num = StringHelper::getSomenteNumeros($alpha);
        $this->assertEquals($result, $num);
    }
    
}
<?php
namespace App\Helpers;

class StringHelper {

  public static function getSomenteNumeros($str){
    return preg_replace("/[^0-9]/", "", $str);
  }
}
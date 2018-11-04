<?php

namespace App\Helpers;

class Mensagem {
    const STATUS_ERROR = 'error';
    const STATUS_SUCCESS = 'success';
    const STATUS_WARNING = 'warning';
    const STATUS_INFO = 'info';

    public static function criarMensagem(string $msg, string $tipo = self::STATUS_ERROR){
      return array(
        'status' => $tipo,
        'mensagem' => $msg
      );
    }

    public static function criarMensagens(Array $msgs, string $tipo = self::STATUS_ERROR){
      $mensagens = [];
      foreach($msgs as $msg) {
        array_push($mensagens, self::criarMensagem($msg, $tipo));
      }
      return $mensagens;
    }
}
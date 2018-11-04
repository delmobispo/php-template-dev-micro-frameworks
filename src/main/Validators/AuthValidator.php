<?php

namespace App\Validators;

use Respect\Validation\Validator;
use DavidePastore\Slim\Validation\Validation;

class AuthValidator{

    public static function get(){
        $validator = array(
            'login' => Validator::notEmpty()->notBlank()->email(),
            'senha' => Validator::notEmpty()->notBlank()
        );
        return new Validation($validator);
    }
}
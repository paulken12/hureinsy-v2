<?php
/**
 * Created by PhpStorm.
 * User: Paulken
 * Date: 11/12/2018
 * Time: 10:50 AM
 */

namespace App\Helper;


class IsEmpty
{

    public function isEmptyString($var) {
        if($var === '' || empty($var)){
            return $var = 'n/a';
        }
        return $var;
    }
}
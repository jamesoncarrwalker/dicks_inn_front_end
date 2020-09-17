<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 10/05/2020
 * Time: 17:15
 */

namespace model\helper;


use interfaces\SanitiserInterface;

class EmailSanitiser implements SanitiserInterface{

    public static function sanitise($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) return $email;
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        return filter_var($email,FILTER_VALIDATE_EMAIL) ? $email : false;
    }
}
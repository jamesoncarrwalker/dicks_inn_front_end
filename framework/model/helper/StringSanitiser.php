<?php
namespace model\helper;
use interfaces\SanitiserInterface;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 17/10/2019
 * Time: 21:44
 */
class StringSanitiser implements SanitiserInterface{

    static function sanitise($string) : string {
        $string = str_replace(['<div>',"\r","\n"],'<br>',$string);
        $string = strip_tags($string,'<br>');
        $string = str_replace(['src','&lt;','&gt;'],'',$string);
        return $string;
    }
}
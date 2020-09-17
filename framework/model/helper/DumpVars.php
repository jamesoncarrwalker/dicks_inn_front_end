<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/04/2020
 * Time: 19:49
 */

namespace model\helper;


class DumpVars {

    public static function dumpAndKill() {
        echo '<pre>';
        foreach(func_get_args() as $arg) {
            var_dump($arg);
        }
        echo '</pre>';
        die();
    }

    public static function dump() {
        echo '<pre>';
        foreach(func_get_args() as $arg) {
            var_dump($arg);
        }
        echo '</pre>';
    }
}
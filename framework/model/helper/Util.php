<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/11/2019
 * Time: 15:15
 */

namespace model\helper;



class Util {

    static public function getSubstringFromTags(string $string, string $openTag, string $closeTag = '', int $offset = 0) {
        $startPos = strpos($string,$openTag,$offset) + strlen($openTag);
        $length = $closeTag == '' ? strlen($string) : strpos($string,$closeTag,$startPos) - $startPos;
        $subStr = substr($string, $startPos, $length);
        return $subStr;
    }
}
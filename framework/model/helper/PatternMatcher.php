<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/05/2020
 * Time: 15:37
 */

namespace model\helper;


class PatternMatcher {

    public static function findStringPatternInStringArray(string $haystack, array $stringNeedleArray) :string {

        $stringNeedleArray = ArraySorter::sortStringArrayByLength($stringNeedleArray, false);

        foreach($stringNeedleArray as $needle) {
            if(strpos($haystack,$needle) !== false) {
                return $needle;
                break;
            }
        }
        return "";
    }

    public static function replaceMarkedUpSectionsOfString(string $string, string $openingChar, string $closingChar,string $replacementString,int $offset = 0) {

        $strPos = strpos($string,$openingChar,$offset);

        while($strPos !== false) {
            $length = strpos($string,$closingChar,$strPos) - $strPos + 1;
            $stringToReplace = substr($string,$strPos,$length);
            $string = str_ireplace($stringToReplace,$replacementString,$string);
            $strPos = strpos($string,$openingChar,$strPos);

        }

        return $string;
    }
}
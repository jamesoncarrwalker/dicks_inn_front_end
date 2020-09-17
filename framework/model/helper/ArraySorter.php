<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 30/03/2020
 * Time: 14:18
 */

namespace model\helper;


class ArraySorter {

    public static function sortStringArrayByLength(array $array, bool $ascending = true) :array {


        usort($array, function($a, $b) {
            $difference =  strlen($a) - strlen($b);
            return $difference ?: strcmp($a, $b);
        });


        return $ascending ? $array : array_reverse($array);
    }

    public static function filterIndexedElementsFromMixedArray(array $mixedKeyIndexArray, bool $maintainIndexes = false) : array {
        $returnArray = [];

        foreach($mixedKeyIndexArray as $key => $value) {
            if(is_numeric($key)) {
                if($maintainIndexes) {
                    $returnArray[$key] = $value;
                } else {
                    $returnArray[] = $value;
                }
            }
        }

        return $returnArray;
    }
}
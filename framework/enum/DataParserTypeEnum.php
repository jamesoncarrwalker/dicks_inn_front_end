<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 04/04/2020
 * Time: 15:52
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

class DataParserTypeEnum extends AbstractBasicEnum {

    const ARRAY = 0;
    const JSON_STRING = 1;
    const QUERY_STRING = 2;
    const STRING = 3;

    public static function getValueForConstant(string $const) {
        self::checkEnumArrayForId();
        return parent::getValueForConstant($const);
    }

    public static function getConstantForValue($value) {
        self::checkEnumArrayForId();
        return parent::getConstantForValue($value);
    }

    public static function setEnumArray() {
        self::$array = [
            self::ID => __CLASS__,
            self::ARRAY => 0,
            self::JSON_STRING => 1,
            self::QUERY_STRING => 2,
            self::STRING => 4
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
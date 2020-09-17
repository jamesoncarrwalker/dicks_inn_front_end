<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 03/05/2020
 * Time: 18:05
 */

namespace enum;


use abstractClass\AbstractBasicEnum;


class AuthLevelEnum extends AbstractBasicEnum {

    const LOGIN = 'LOGIN';
    const CONNECTED = 'CONNECTED';
    const PUBLIC = 'PUBLIC';

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
            self::LOGIN => 1,
            self::CONNECTED => 2,
            self::PUBLIC => 0
        ];
    }

    public static function checkEnumArrayForId() {
       if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
           self::setEnumArray();
       }
    }
}
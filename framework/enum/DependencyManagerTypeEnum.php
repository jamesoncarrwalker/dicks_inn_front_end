<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/03/2020
 * Time: 16:36
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

class DependencyManagerTypeEnum extends AbstractBasicEnum {

    const WEB = 'WEB';
    const API = 'API';

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
            self::WEB => 'web',
            self::API => 'api',
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
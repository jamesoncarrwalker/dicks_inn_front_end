<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/10/2019
 * Time: 13:14
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

abstract class FinderTypesEnum extends AbstractBasicEnum {

    const CONTROLLER = 'CONTROLLER';
    const CONFIG = 'CONFIG';

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
            self::CONTROLLER => 'CONTROLLER',
            self::CONFIG => 'CONFIG'
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
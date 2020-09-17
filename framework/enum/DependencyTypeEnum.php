<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 22:50
 */

namespace enum;

use abstractClass\AbstractBasicEnum;


class DependencyTypeEnum extends AbstractBasicEnum {

    /**
     * keys for the array
     */
    const WEB_CONTROLLER = 'WEB_CONTROLLER';


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
            self::WEB_CONTROLLER => 'web controller dependency',
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
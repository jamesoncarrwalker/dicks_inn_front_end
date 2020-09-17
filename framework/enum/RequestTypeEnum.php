<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 21:23
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

abstract class RequestTypeEnum extends AbstractBasicEnum {
    const WEB = "WEB";
    const API = "API";
    const AJAX = "AJAX";
    const UNKNOWN = "UNKNOWN";


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
            self::WEB => 'WEB_REQUEST',
            self::API => 'API_REQUEST',
            self::AJAX => 'AJAX_REQUEST',
            self::UNKNOWN => 'UNKNOWN_REQUEST',
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
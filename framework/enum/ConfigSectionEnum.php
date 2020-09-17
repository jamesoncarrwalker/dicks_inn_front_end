<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/04/2020
 * Time: 19:25
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

class ConfigSectionEnum extends AbstractBasicEnum{

    const DATA_SOURCE = 'DATA_SOURCE';
    const CONFIG_PATH = 'CONFIG_PATH';
    const DEPENDENCY = 'DEPENDENCY';
    const ENTRY_POINT = 'ENTRY_POINT';
    const ENTRY_POINT_WEB = 'WEB';
    const ENTRY_POINT_API = 'API';
    const SERVER_ROOT = 'SERVER_ROOT';
    const SERVER_ROOT_DEV = 'DEV';
    const SERVER_ROOT_PROD = 'PROD';
    const EXTENDS = 'EXTENDS';

    public static function getValueForConstant(string $const) {
        return parent::getValueForConstant($const);
    }

    public static function getConstantForValue($value) {
        return parent::getConstantForValue($value);
    }

    public static function setEnumArray() {
        self::$array = [
            self::ID => __CLASS__,
            self::DATA_SOURCE => 'DATA_SOURCE',
            self::CONFIG_PATH => 'CONFIG_PATH',
            self::ENTRY_POINT => 'ENTRY_POINT',
            self::ENTRY_POINT_WEB => 'WEB',
            self::ENTRY_POINT_API => 'API',
            self::SERVER_ROOT => 'SERVER_ROOT',
            self::SERVER_ROOT_DEV => 'DEV',
            self::SERVER_ROOT_PROD => 'PROD',
            self::EXTENDS => 'EXTENDS'
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
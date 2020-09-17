<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 04/04/2020
 * Time: 15:23
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

Abstract class RequestMethodEnums extends AbstractBasicEnum {

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';


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
            self::GET => 'GET',
            self::POST => 'POST',
            self::PUT => 'PUT',
            self::PATCH => 'PATCH',
            self::DELETE => 'DELETE'
        ];
    }

    public static function checkEnumArrayForId() {
        if(!isset(self::$array) || self::$array[self::ID] !=__CLASS__ ) {
            self::setEnumArray();
        }
    }
}
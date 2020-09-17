<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/04/2020
 * Time: 11:47
 */
namespace model\testClasses;
class BasicObject {

    protected $boolean = true;

    public function __construct() {

    }

    public function getBool() {
        return $this->boolean;
    }
}
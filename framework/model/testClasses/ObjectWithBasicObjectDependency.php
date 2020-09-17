<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/04/2020
 * Time: 11:49
 */
namespace model\testClasses;

class ObjectWithBasicObjectDependency {

    protected $basicObject;

    public function __construct(BasicObject $basicObject) {
        $this->basicObject = $basicObject;
    }

    public function getBoolFromBasicObject() {
        return $this->basicObject->getBool();
    }
}
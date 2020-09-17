<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/04/2020
 * Time: 13:57
 */

namespace model\testClasses;


class ObjectWithRequestStringDependency {

    protected $string;

    public function __construct(string $requestString) {
        $this->string = $requestString;
    }

    public function getStringValue() {
        return $this->string;
    }

}
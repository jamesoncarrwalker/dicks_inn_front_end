<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 28/10/2019
 * Time: 13:44
 */

namespace interfaces;


interface ObjectManagerInterface {

    public function getProperty(string $name);

    public function setProperty(string $name,$value);

    public function getObject();

    public function resetObject();
}
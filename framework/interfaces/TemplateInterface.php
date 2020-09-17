<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 18/05/2020
 * Time: 20:04
 */

namespace interfaces;


interface TemplateInterface extends ParseStringInterface {
    public function setTemplate(string $name, array $data = []);
}
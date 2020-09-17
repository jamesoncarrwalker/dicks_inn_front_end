<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 30/03/2020
 * Time: 15:30
 */

namespace interfaces;


interface FileParseInterface {

    public function parseFile();

    public function setFile(string $fileName);

}
<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/04/2020
 * Time: 15:52
 */

namespace model\fileReader;


use abstractClass\AbstractFileReader;

class IniFileReader extends AbstractFileReader{

    public function parseFile() {
        if($contents = parse_ini_file($this->filePathFinder->getResult(),true)) {
            return $contents;
        }
        return false;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 11/04/2020
 * Time: 12:43
 */

namespace model\fileReader;


use abstractClass\AbstractFileReader;


class JsonFileReader extends AbstractFileReader {


    public function parseFile() {
       if($contents = file_get_contents($this->filePathFinder->getResult())){
           $json = trim($contents);
           return json_decode($json,true);
       }
        throw new \Exception("Could not parse file from fileReader: " . print_r($this->filePathFinder));
    }

}

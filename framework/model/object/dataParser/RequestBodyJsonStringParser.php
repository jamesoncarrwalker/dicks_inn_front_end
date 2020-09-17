<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/05/2020
 * Time: 20:08
 */

namespace model\object\dataParser;


use abstractClass\AbstractHttpRequestDataParser;

class RequestBodyJsonStringParser extends AbstractHttpRequestDataParser {

    private $jsonData;
    private $jsonString;

    public function __construct(string $uriString, string $jsonString) {
        parent::__construct($uriString);
        $this->jsonString = $jsonString;
    }


    public function parseData() {
       if(!$this->isValidJasonString()) {
           $this->jsonData = ['error' => $this->jsonData];
       }
    }

    public function getParsedData() {

        if(!isset($this->jsonData)) {
            $this->parseData();
        }

        return array_merge($this->uriParams,$this->jsonData);
    }

    private function isValidJasonString():bool {
        $jsonArray = json_decode($this->jsonString,true);
        $jsonError = json_last_error();
        if( $jsonError === JSON_ERROR_NONE) {
            $this->jsonData = $jsonArray;
            return true;
        } else {
            $this->jsonData = json_last_error_msg();
            return false;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 04/04/2020
 * Time: 16:00
 */

namespace model\object\dataParser;


use abstractClass\AbstractHttpRequestDataParser;
use model\helper\StringSanitiser;

class QueryStringDataParser extends AbstractHttpRequestDataParser {

    protected $queryString;
    protected $queryStringData;


    public function parseData() {
        $this->setQueryString();
        $this->setQueryStringData();
    }

    public function getParsedData() {
        if(!isset($this->uriParams)) {
            $this->setUriParams();
        }

        if(!isset($this->queryStringData)) {
            $this->parseData();
        }
        return array_merge($this->uriParams,$this->queryStringData);
    }


    private function setQueryString() {

        $this->queryString = strpos($this->uriString,'&') === false ? "" : substr($this->uriString,strpos($this->uriString,'&'));

    }

    private function setQueryStringData() {
        parse_str(StringSanitiser::sanitise($this->queryString),$this->queryStringData);
    }
}
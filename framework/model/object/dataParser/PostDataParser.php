<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/09/2020
 * Time: 21:07
 */

namespace model\object\dataParser;


use abstractClass\AbstractHttpRequestDataParser;
use model\helper\StringSanitiser;

class PostDataParser extends AbstractHttpRequestDataParser {

    private $postData;
    private $parsedPostData;

    public function __construct(string $uriString, array $postData) {
        parent::__construct($uriString);
        $this->postData = $postData;
    }
    public function parseData() {

        if(count($this->postData) > 0) {
            foreach($this->postData as $key => $value) {
                if(is_string($value)) {
                    $value = StringSanitiser::sanitise($value);
                }

                if(is_numeric($value)) {
                    $value = intval($value);
                }
                $this->parsedPostData[$key] = $value;
            }
        } else {
            $this->parsedPostData = [];
        }


    }

    public function getParsedData() {

        if(!isset($this->parsedPostData)) {
            $this->parseData();
        }

        return array_merge($this->uriParams, $this->parsedPostData);
    }
}
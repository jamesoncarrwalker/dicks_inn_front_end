<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 04/04/2020
 * Time: 16:07
 */

namespace model\helper;


use enum\DataParserTypeEnum;

class HttpDataParserFactoryType {

    static public function getParserType() : int {
        switch($_SERVER['REQUEST_METHOD']) {
            case "POST":
                return DataParserTypeEnum::ARRAY;
            case "PUT":
            case "PATCH":
            case "DELETE":
                return DataParserTypeEnum::JSON_STRING;
            default :
                return DataParserTypeEnum::QUERY_STRING;
        }
    }

}
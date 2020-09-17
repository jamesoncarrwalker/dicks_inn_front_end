<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 06/04/2020
 * Time: 15:56
 */

namespace model\helper;


use enum\RequestMethodEnums;

class HttpRequestRawData {

    public static function getRawDataForRequest(string $requestType):array {

        switch($requestType) {
            case RequestMethodEnums::POST :
                $data = $_POST ?? [];
                break;
            case RequestMethodEnums::GET:
                $data = [];
                break;
            default:
                $data = file_get_contents("php://input");
                break;
        }
        return [$_SERVER['QUERY_STRING'],$data];
    }
}
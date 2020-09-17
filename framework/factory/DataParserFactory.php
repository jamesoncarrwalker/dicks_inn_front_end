<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 04/04/2020
 * Time: 15:38
 */

namespace factory;


use enum\DataParserTypeEnum;
use model\object\dataParser\PostDataParser;
use model\object\dataParser\QueryStringDataParser;
use model\object\dataParser\RequestBodyJsonStringParser;

class DataParserFactory {

    /**
     * @param string $type
     * @param $rawData
     * @return QueryStringDataParser|RequestBodyJsonStringParser
     *
     * $rawData comes from HttpRequestRawData::getRawDataForRequest
     *
     * this is in the format [$queryString, $data] so we use ... to pass the array values to the dataParser
     * the AbstractHttpRequestDataParser takes the query string as it's first dependency, and all others extend from this
     */

    public static function create(string $type, $rawData) {

        switch($type) {
            case DataParserTypeEnum::ARRAY:
                return new PostDataParser(...$rawData);
            case DataParserTypeEnum::JSON_STRING:
                return new RequestBodyJsonStringParser(...$rawData);
            default:
                return new QueryStringDataParser(...$rawData);
        }

    }
}
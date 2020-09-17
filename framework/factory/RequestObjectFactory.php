<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 19:35
 */

namespace factory;


use abstractClass\AbstractConfigObject;
use interfaces\HTTPManagerInterface;
use interfaces\ParseDataInterface;
use model\request\HttpDeleteRequestObject;
use model\request\HttpGetRequestObject;
use model\request\HttpPatchRequestObject;
use model\request\HttpPostRequestObject;
use model\request\HttpPutRequestObject;


class RequestObjectFactory {

    static public function createRequestObjectFromHttpRequest(AbstractConfigObject $config, ParseDataInterface $parseData, bool $dev = false) : HTTPManagerInterface {
        switch($_SERVER['REQUEST_METHOD']) {

            case 'POST':
                return new HttpPostRequestObject($config, $parseData, $dev);
            case 'PUT':
                return new HttpPutRequestObject($config, $parseData, $dev);
            case 'PATCH':
                return new HttpPatchRequestObject($config, $parseData, $dev);
            case 'DELETE':
                return new HttpDeleteRequestObject($config, $parseData, $dev);
            default:
                return new HttpGetRequestObject($config, $parseData, $dev);
        }
    }
}
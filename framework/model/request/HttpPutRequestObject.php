<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/03/2020
 * Time: 23:07
 */

namespace model\request;


use abstractClass\AbstractHttpRequestObject;
use enum\RequestMethodEnums;

class HttpPutRequestObject extends AbstractHttpRequestObject {

    public function setRequestMethod():void {
        $this->requestMethod = RequestMethodEnums::PUT;
    }
}
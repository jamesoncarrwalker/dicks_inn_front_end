<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/03/2020
 * Time: 23:08
 */

namespace model\request;


use abstractClass\AbstractHttpRequestObject;
use enum\RequestMethodEnums;


class HttpDeleteRequestObject extends AbstractHttpRequestObject {


    public function setRequestMethod():void {
        $this->requestMethod = RequestMethodEnums::DELETE;
    }
}
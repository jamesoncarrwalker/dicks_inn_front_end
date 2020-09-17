<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 03/05/2020
 * Time: 13:04
 */

namespace abstractClass;


use interfaces\ParseDataInterface;
use model\helper\StringSanitiser;


abstract class AbstractHttpRequestDataParser extends AbstractObjectManager implements ParseDataInterface {

    protected $uriString;
    protected $uriParams;

    public function __construct(string $uriString) {
        $this->uriString = StringSanitiser::sanitise($uriString);
        $this->setUriParams();

    }

    protected function setUriParams() {
        if(strpos($this->uriString,'&') === false) {
            $uriParamString = $this->uriString;
        } else {
            $uriParamString = substr($this->uriString,0,strpos($this->uriString,'&'));
        }

        if($uriParamString == '/') {
            $this->uriParams = ['/'];
        } else {
            $this->uriParams = array_values(array_filter(explode('/',$uriParamString)));
        }
    }

}
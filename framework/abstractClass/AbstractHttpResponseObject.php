<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 09/05/2020
 * Time: 11:38
 */

namespace abstractClass;


 use interfaces\ResponseHeadersManagerInterface;
 use interfaces\ResponseInterface;


abstract class AbstractHttpResponseObject implements ResponseInterface, ResponseHeadersManagerInterface {

    protected $responseData;
    protected $headers = [];
    protected $response;

    public function setResponseData(string $name, $data) {
        $this->responseData[$name] = $data;
    }

    public function outputResponse() {
        $this->setResponse();
        echo $this->response;
    }

    public function setHeaders() {
        $this->setBasicHeaders();
        foreach($this->headers as $header) {
            $split = explode(':', $header);
            $this->setHeader($split[0],$split[1]);
        }
    }

    abstract public function setResponse();

    abstract public function setBasicHeaders();

    public function getHeaders():array {
        $this->setHeaders();
        return headers_list();
    }

    public function clearHeaders() {
        header_remove();
    }

    public function setHeader(string $name, $value) {
        header("$name:$value");
    }

    public function clearHeader(string $name) {
        header_remove($name);
    }

 }
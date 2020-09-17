<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 17:26
 */

namespace abstractClass;


use enum\ContainerContentsEnum;
use interfaces\ControllerInterface;
use interfaces\PersistentStateManagerInterface;
use interfaces\ResponseInterface;

abstract class AbstractController implements ControllerInterface {

    protected $response;
    protected $container;
    private $action;

    public function __construct(PersistentStateManagerInterface $container, string $action) {
        $this->container = $container;
        $this->action = $action;
        $this->response = $this->container->getStateVariable(ContainerContentsEnum::RESPONSE);
    }

    public function getResponse() :ResponseInterface  {
        return $this->container->getStateVariable(ContainerContentsEnum::RESPONSE);
    }

    public function runRequest() {
            $data = func_get_args();
            $action = $this->action;
            $this->$action(...$data);

    }


    public function setData(string $key, $value) {
        $this->response->setResponseData($key, $value);
    }

    public function getData(string $key) {
       return $this->container->getStateVariable(ContainerContentsEnum::REQUEST)->getRequestData()[$key] ?? null;
    }

    public function getAllRequestData() {
       return $this->container->getStateVariable(ContainerContentsEnum::REQUEST)->getRequestData() ?? [];
    }


}
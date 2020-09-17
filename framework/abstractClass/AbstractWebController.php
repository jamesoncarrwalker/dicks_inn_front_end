<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 22:05
 */

namespace abstractClass;

use enum\ContainerContentsEnum;
use interfaces\PersistentStateManagerInterface;
use model\container\WebContainer;

abstract class AbstractWebController extends AbstractController {

    protected $session;
    protected $cookie;

    public function __construct(WebContainer $container,string $requestAction) {
        parent::__construct($container,$requestAction);
        $this->cookie = $this->container->getStateVariable(ContainerContentsEnum::COOKIE);
        $this->session = $this->container->getStateVariable(ContainerContentsEnum::SESSION);
    }

    protected function setTemplate(string $templateName) {
        $this->response->setResponseData('template', $templateName);
    }

    protected function setSession(string $name,$value) {
        $this->session->setStateVariable($name,$value);
    }

    protected function getSession(string $name) {
        if($this->session->stateVariableExists($name)) {
            return $this->session->getStateVariable($name);
        }
        return null;
    }

    protected function destroySession() {
        if($this->session instanceof PersistentStateManagerInterface) {
            $this->session->resetState();
        }
    }

 }
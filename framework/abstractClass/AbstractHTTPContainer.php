<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 27/04/2020
 * Time: 17:49
 */


namespace abstractClass;

use enum\ContainerContentsEnum;
use interfaces\AuthenticatorInterface;
use interfaces\DependencyManagerInterface;
use interfaces\HTTPManagerInterface;
use interfaces\PersistentStateManagerInterface;
use interfaces\ResponseInterface;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 22:13
 */
abstract class AbstractHTTPContainer implements PersistentStateManagerInterface {

    protected $originalContainerState;
    protected $currentContainer;
    protected $availableWebContainerSections = [  ContainerContentsEnum::REQUEST,
                                                ContainerContentsEnum::RESPONSE,
                                                ContainerContentsEnum::CONN,
                                                ContainerContentsEnum::AUTH,
                                                ContainerContentsEnum::DEPMAN,
                                            ];


    public function __construct(HTTPManagerInterface $requestObject, ResponseInterface $responseObject, AbstractConnectionObject $conn, AuthenticatorInterface $authenticator, DependencyManagerInterface $dependencyManager) {
        $this->originalContainerState[ContainerContentsEnum::REQUEST] = $requestObject;
        $this->originalContainerState[ContainerContentsEnum::RESPONSE] = $responseObject;
        $this->originalContainerState[ContainerContentsEnum::CONN] = $conn;
        $this->originalContainerState[ContainerContentsEnum::AUTH] = $authenticator;
        $this->originalContainerState[ContainerContentsEnum::DEPMAN] = $dependencyManager;
        $this->resetState();


    }

    public function setStateVariable(string $name, $value) {
        if($this->isValidContainerParam($name)) $this->currentContainer[$name] = $value;
    }

    public function getStateVariable(string $name) {
        return $this->isValidContainerParam($name) ? $this->currentContainer[$name] : false;
    }

    public function unsetStateVariable(string $name) {
        unset($this->currentContainer[$name]);
    }

    public function resetState() {
        $this->currentContainer = $this->originalContainerState;
    }

    private function isValidContainerParam(string $name):bool {
        return in_array($name,$this->availableWebContainerSections);
    }

    public function stateVariableExists(string $name) :bool {
        if(!$this->isValidContainerParam($name)) return false;
        return isset($this->currentContainer[$name]);
    }
}
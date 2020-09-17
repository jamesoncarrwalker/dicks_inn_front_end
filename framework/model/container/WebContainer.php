<?php
namespace model\container;

use abstractClass\AbstractHTTPContainer;
use enum\ContainerContentsEnum;
use abstractClass\AbstractConnectionObject;
use interfaces\AuthenticatorInterface;
use interfaces\DependencyManagerInterface;
use interfaces\HTTPManagerInterface;
use interfaces\PersistentStateManagerInterface;
use model\response\WebResponseObject;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 22:13
 */
class WebContainer extends AbstractHTTPContainer {

        protected $availableWebContainerSections = [  ContainerContentsEnum::REQUEST,
                                                ContainerContentsEnum::RESPONSE,
                                                ContainerContentsEnum::CONN,
                                                ContainerContentsEnum::AUTH,
                                                ContainerContentsEnum::SESSION,
                                                ContainerContentsEnum::COOKIE,
                                                ContainerContentsEnum::DEPMAN,
                                            ];


        public function __construct(HTTPManagerInterface $requestObject, WebResponseObject $responseObject, AbstractConnectionObject $conn, AuthenticatorInterface $authenticator, DependencyManagerInterface $dependencyManager,PersistentStateManagerInterface $sessionManager, PersistentStateManagerInterface $cookieManager) {

        $this->originalContainerState[ContainerContentsEnum::SESSION] = $sessionManager;
        $this->originalContainerState[ContainerContentsEnum::COOKIE] = $cookieManager;

        parent::__construct($requestObject,$responseObject,$conn,$authenticator,$dependencyManager);
    }
}
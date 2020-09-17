<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 09/11/2019
 * Time: 23:06
 */

namespace abstractClass;


use enum\AuthLevelEnum;
use enum\ContainerContentsEnum;
use enum\RequestMethodEnums;
use interfaces\ControllerInterface;
use interfaces\FinderInterface;
use interfaces\PersistentStateManagerInterface;
use interfaces\ResponseInterface;
use interfaces\ValidatorInterface;
use model\dependencyManager\HttpDependencyManager;
use model\helper\ControllerDataParamsFilter;
use model\object\config\RouteRegisterObject;


abstract class AbstractFrontController implements ControllerInterface, ValidatorInterface {



    protected $container;
    protected $dependencyManager;
    protected $requestObject;
    protected $routesFilePath;
    protected $routeRegister;
    protected $controllerName;
    protected $controllerRequestType;
    protected $controllerRequestMethod;
    protected $authenticator;
    protected $routeFinderService;

    protected $instantiatedController;

    protected $isAuthorised;

    public function __construct(PersistentStateManagerInterface $container, FinderInterface $routeFinderService) {
        $this->container = $container;
        $this->requestObject = $this->container->getStateVariable(ContainerContentsEnum::REQUEST)??null;
        $this->routeFinderService = $routeFinderService;
        if($this->requestObject instanceof AbstractHttpRequestObject) {
            $this->dependencyManager = $this->container->getStateVariable(ContainerContentsEnum::DEPMAN);
            $this->routeRegister = $this->routeFinderService->getResult();
            $this->authenticator = $this->container->getStateVariable(ContainerContentsEnum::AUTH);
        } else {
            throw new \Exception('Not an HTTP request object');
        }
    }


    public function isValid() :bool {
        if($this->routeRegister instanceof RouteRegisterObject) {
            $this->controllerRequestType = $this->routeRegister->getRequestMethodForRoute()??false;

            $requestMethodIsValid = ( $this->controllerRequestType == false ||  $this->controllerRequestType == $this->requestObject->getRequestMethod());

            $this->controllerName = $this->routeRegister->getRouteController();
            $this->controllerRequestMethod = $this->routeRegister->getRouteControllerMethod() ?? strtolower($this->requestObject->getRequestMethod());

            return ($requestMethodIsValid && class_exists($this->controllerName) && method_exists($this->controllerName,$this->controllerRequestMethod));

        } else {
            throw new \Exception("Could not read route register");
        }
    }


    public function runRequest() {
        $this->checkAuthLevelIsCorrect();
        if($this->isAuthorised) {
            if($this->isValid()) {
                $this->setRequestActionDependency($this->controllerRequestMethod);

                /**
                 *
                 *
                 * HERE WE WILL MERGE IN THE DATA FROM THE QUERY STRING TO GIVE TO THE CONTROLLER METHOD
                 * USING ControllerDataParamsFilter - I THINK WE WANT TO USER AN ARRAY MERGE WITH THE
                 * DEPMAN RESULT.
                 *
                 *
                 */




                $this->instantiatedController = new $this->controllerName(...$this->dependencyManager->getDependencies($this->controllerName));
                $this->setResponseStatus();
                $this->runInstantiatedControllerRequest();
            } else {
                $this->setLostResponse();
            }

        }  else {
            if($redirectController = $this->routeRegister->getRedirectController()) {
                $this->setRequestActionDependency('get');
                $this->instantiatedController = new $redirectController(...$this->dependencyManager->getDependencies($redirectController));
                $this->setResponseStatus();
                $this->runInstantiatedControllerRequest();
            } else {
                $this->setUnauthorisedResponse();
            }

        }
    }

    protected function setResponseStatus(int $status = 200) {
        http_response_code($status);
    }

    public abstract function setUnauthorisedResponse();

    public abstract function setLostResponse();


    private function checkAuthLevelIsCorrect()  {
        $authLevel = $this->routeRegister->getAuthLevel();
        if($authLevel == AuthLevelEnum::getValueForConstant(AuthLevelEnum::PUBLIC))  {
            $this->isAuthorised = true;
        } else {
            $this->isAuthorised = $this->authenticator->checkAuthLevel($this->routeRegister->getAuthLevel());
        }
    }

    private function runInstantiatedControllerRequest() {
        $methodParams = ControllerDataParamsFilter::getControllerDataParams($this->routeFinderService->getEntryPattern(),$this->requestObject->getRequestData()??[]);
        $this->instantiatedController->runRequest(...$methodParams);
    }

    public function getResponse() :ResponseInterface {
        return $this->instantiatedController->getResponse();
    }

    protected function setRequestActionDependency(string $requestAction = null) {
        if($this->dependencyManager instanceof HttpDependencyManager) {
            $this->dependencyManager->addInstantiatedDependency('requestAction',$requestAction ?? strtolower(RequestMethodEnums::getValueForConstant(RequestMethodEnums::GET)));
        }

    }

}
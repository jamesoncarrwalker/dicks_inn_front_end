<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 03/05/2020
 * Time: 18:01
 */

namespace model\object\config;


use enum\AuthLevelEnum;

class RouteRegisterObject {

    private $authLevel;
    private $routeController;
    private $redirectController;
    private $requestMethod;
    private $registrationEntry;
    private $controllerMethod;

    public function __construct($registrationEntry) {
        $this->registrationEntry = $registrationEntry;
        $this->setAuthLevel();
        $this->setRouteController();
        $this->setRedirectController();
        $this->setRequestMethodRequiredForRoute();
    }

    private function setAuthLevel() {

        if(is_string($this->registrationEntry) || !isset($this->registrationEntry['AUTH'])){
            $this->authLevel = AuthLevelEnum::getValueForConstant(AuthLevelEnum::PUBLIC);
        } else {
            $this->authLevel =  AuthLevelEnum::getValueForConstant(array_keys($this->registrationEntry['AUTH'])[0]);
        }
    }

    public function getAuthLevel() {
        return $this->authLevel;
    }

    private function setRouteController() {
        $authLevel = $this->registrationEntry['AUTH'] ?? false;
        if(is_array($authLevel)) {
            $controller = array_values($authLevel)[0];
        } else {
            $controller = false;
        }

        if(!$controller) {
            $controller = $this->registrationEntry['ROUTE'] ?? false;
        }
        if(!$controller) {
            $controller = $this->registrationEntry;
        }
        if(isset($controller)) {
            $this->routeController = $this->getControllerNameFromRouteRegisterString($controller);
        } else {
            $this->routeController = 'UNREGISTERED';
        }

    }

    private function getControllerNameFromRouteRegisterString(string $controller, string $delimiter = '::') {
        $methodDelimiterPosition = strpos($controller,$delimiter);
        if($methodDelimiterPosition !== false) {
            $this->controllerMethod = substr($controller,$methodDelimiterPosition + strlen($delimiter));
            $controller = substr($controller,0,$methodDelimiterPosition);

        }
       return "controller\\" . $controller . "Controller";
    }

    public function getRouteController() {
        return $this->routeController;
    }

    public function getRouteControllerMethod() {
        return $this->controllerMethod;
    }

    private function setRedirectController() {
        $this->redirectController = $this->getControllerNameFromRouteRegisterString($this->registrationEntry['REDIRECT'] ?? "");
    }

    public function getRedirectController() {
        return $this->redirectController;
    }

    private function setRequestMethodRequiredForRoute() {
        $this->requestMethod = $this->registrationEntry['METHOD'] ?? null;
    }

    public function getRequestMethodForRoute() {
        return $this->requestMethod;
    }
}
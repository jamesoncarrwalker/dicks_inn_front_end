<?php
namespace frontController;

use abstractClass\AbstractFrontController;


/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 14:39
 */
class WebFrontController extends AbstractFrontController {

    public function setUnauthorisedResponse() {
        //TODO:: LOOK IN THE CONFIG FOR THE FORBIDDEN ROUTE
        $this->setResponseStatus(403);
        $this->controllerName = "controller\\web\\ForbiddenController";
        $this->setRequestActionDependency();
        $this->instantiatedController = new $this->controllerName(...$this->dependencyManager->getDependencies($this->controllerName));
    }

    public function setLostResponse() {
        //TODO:: LOOK IN THE CONFIG FOR THE LOST ROUTE
        $this->setResponseStatus(404);
        $this->controllerName = "controller\\web\\LostController";
        $this->setRequestActionDependency();
        $this->instantiatedController = new $this->controllerName(...$this->dependencyManager->getDependencies($this->controllerName));
    }
}
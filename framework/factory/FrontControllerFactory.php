<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 14:02
 */
namespace factory;

use abstractClass\AbstractFrontController;
use enum\RequestTypeEnum;
use frontController\ApiFrontController;
use frontController\WebFrontController;
use interfaces\ConfigInterface;
use interfaces\FileParseInterface;
use interfaces\HTTPManagerInterface;
use model\helper\ArraySorter;
use model\service\RouteFinderService;


class FrontControllerFactory {

    public static function createHttpFrontController(HTTPManagerInterface $requestObject, ConfigInterface $frameworkConfig, ConfigInterface $appConfig, FileParseInterface $fileReader) : AbstractFrontController {

        $dependencyManager = DependencyManagerFactory::createHttpDependencyManager($frameworkConfig,$appConfig,$requestObject,$fileReader);

        $appRequestType = $requestObject->getAppRequestType();

        $fileReader->setFile(self::setRoutesFilePath($requestObject->getEntryPoint(),$appConfig->getConfigFileType()));

        $routeFinder = new RouteFinderService($fileReader,
            ArraySorter::filterIndexedElementsFromMixedArray($requestObject->getRequestData()),
            $appRequestType);

        $dependencyManager->addInstantiatedDependency('routeFinderService',$routeFinder);
        switch($appRequestType) {
                case RequestTypeEnum::WEB:
                    return new WebFrontController(...$dependencyManager->getDependencies('frontController\WebFrontController'));
                case RequestTypeEnum::API:
                    return new ApiFrontController(...$dependencyManager->getDependencies('frontController\ApiFrontController'));
                case RequestTypeEnum::AJAX:
                    //TODO:: return an ajax controller (will probably be a web controller with a json output
                    return null;
                default:
                    return null;
            }
    }

    private static function setRoutesFilePath(string $entryPoint, string $configFileExtension) {
        $filePath = str_replace('app','app/config/routes',$entryPoint) . '/routes' . $configFileExtension;
        return $filePath;
    }

}
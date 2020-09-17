<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/04/2020
 * Time: 20:51
 */

namespace model\service;




use interfaces\FileParseInterface;
use interfaces\FinderInterface;
use interfaces\UrlRouteInterface;
use model\helper\ArraySorter;
use model\helper\PatternMatcher;
use model\object\config\RouteRegisterObject;

class RouteFinderService implements FinderInterface,UrlRouteInterface {

    private $allRoutes;
    private $route;
    private $routeUrlPattern;
    private $fileReader;
    private $requestData;
    private $appRequestType;

    public function __construct(FileParseInterface $fileReader, array $requestData, string $appRequestType) {
        $this->fileReader = $fileReader;
        $this->requestData = $requestData;
        $this->appRequestType = $appRequestType;
    }
    /**
     * @return mixed
     */
    public function getResult() :RouteRegisterObject {
        if(!isset($this->allRoutes)) {
            $this->setRoutes();
        }
        $this->runSearch();

        return new RouteRegisterObject($this->route);
    }

    public function getRouteString():string {
        return $this->route ?? "";
    }

    public function getEntryPattern(): string{
        if(!isset($this->routeUrlPattern)) {
            $this->runSearch();
        }

        return $this->routeUrlPattern ?? "unknown";
    }

    /**
     * @return mixed
     */
    public function runSearch() :void {
        if(!isset($this->allRoutes)) {
            $this->setRoutes();
        }
        $this->setRouteRegistration();
    }

    private function setRoutes() {
        $this->clearAllRoutesData();
        $this->allRoutes = $this->fileReader->parseFile();
    }

    private function clearAllRoutesData() {
        $this->allRoutes = null;
        $this->route = null;
    }

    private function setRouteRegistration() {
        $possibleMatches = $this->getPossibleMatchesBasedOnInitialParam($this->requestData[0]??"/");
        $routePattern = $this->getRoutePattern();
        $this->route = $this->filterPossibleMatches($routePattern,$possibleMatches);
    }

    private function getRoutePattern(): string {
        return '/' . implode('/',$this->requestData??[]);
    }

    private function getPossibleMatchesBasedOnInitialParam(string $pattern):array {
        $possibleMatches = [];
        foreach(array_keys($this->allRoutes) as $possibleMatch) {

            if(strpos($possibleMatch,$pattern) !== false) {
                $possibleMatches[] = $possibleMatch;
            }
        }

        return $possibleMatches;
    }

    private function filterPossibleMatches(string $pattern, array $possibleMatches) {

        if(count($possibleMatches) == 0) {
            return $this->createRouteFromPattern($pattern);
        }

        //if the pattern matches a route registration exactly we don't need to check for params
        if(in_array($pattern,$possibleMatches,true)) {
            return $this->allRoutes[$pattern];
        }

        //otherwise sort the array by length and start to check
        $possibleMatchesSorted = ArraySorter::sortStringArrayByLength($possibleMatches);
        $patternParamsCount = $this->getParamsCount($pattern);

        foreach($possibleMatchesSorted as $routeEntryKey) {
            //check if we have the same number of params in the pattern and the entry, otherwise move on
            if($patternParamsCount == $this->getParamsCount($routeEntryKey)) {
                $placemarkedRouteEntryKey = PatternMatcher::replaceMarkedUpSectionsOfString($routeEntryKey,'[',']','PARAM',1);
                if(substr_count($placemarkedRouteEntryKey,"PARAM") == substr_count($routeEntryKey,'[')) {
                    $this->routeUrlPattern = $routeEntryKey;
                    return $this->allRoutes[$routeEntryKey];
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
        return null;

    }


    private function createRouteFromPattern(string $pattern) {
        $newPattern = array_filter(explode('/',$pattern));
        array_walk($newPattern,function(&$part){
           $part = "\\" . ucfirst($part);
        });

        return strtolower($this->appRequestType) . implode("",$newPattern);

    }

    private function getParamsCount(string $string) :int {
        return abs(substr_count($string,'/',1));
    }

    /**
     * @param string $objectProperty
     * @param null $value
     * @return mixed
     * @throws \Exception
     */
    public function setParams(string $objectProperty = "FILE", $value = null):void {
        $this->clearAllRoutesData();
        if(property_exists($this,$objectProperty)) {
            $this->{$objectProperty} = $value;
        } else if($objectProperty == 'FILE') {
            $this->fileReader->setFile($value);
        } else {
            throw new \Exception("$objectProperty is not a valid property for " . __CLASS__);
        }
    }

}
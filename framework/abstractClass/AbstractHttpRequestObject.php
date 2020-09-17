<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/03/2020
 * Time: 23:24
 */

namespace abstractClass;


use enum\RequestTypeEnum;
use interfaces\ConfigInterface;
use interfaces\HTTPManagerInterface;
use interfaces\ParseDataInterface;
use model\helper\ArraySorter;
use model\helper\PatternMatcher;

abstract class AbstractHttpRequestObject extends AbstractObjectManager implements HTTPManagerInterface {

    protected $requestData;
    protected $requestMethod;
    protected $config;
    protected $serverRoot;
    protected $parsedUri;
    protected $appEntryPoint;
    protected $appRequestType;
    protected $requestDataParser;

    public function __construct(ConfigInterface $config, ParseDataInterface $dataInterface, bool $dev = false) {
        $this->config = $config;
        $this->requestDataParser = $dataInterface;
        $this->setRequestMethod();
        $this->serverRoot = $this->config->getServerRoots()[$dev ? 'DEV' : 'PROD'];
        $this->parseUri();
    }

    public function parseUri():void {
        $this->appEntryPoint = null;
        $this->parsedUri = null;
        if(!isset($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '') {
            throw new \Exception("No request set");
        }
        $this->parsedUri = substr(explode('?', $_SERVER['REQUEST_URI'])[0], strlen($this->serverRoot) -1);
        $this->setEntryPoint();
    }

    /**
     * @return string
     *
     * returns a string that the app can recognise as a route pattern
     */

    public function getUriStringForApp(): string {
        if($this->parsedUri == null) $this->parseUri();
        return $this->parsedUri;
    }

    public function setEntryPoint():void {
        if(isset($this->appEntryPoint)) return;
        if(!isset($this->parsedUri)) $this->parseUri();

        $configEntryPointsArray = $this->config->getEntryPoints();

        $configEntryPoints = array_merge($configEntryPointsArray['WEB'],$configEntryPointsArray['API'],$configEntryPointsArray['AJAX']);

        $pattern = PatternMatcher::findStringPatternInStringArray($this->parsedUri,array_keys($configEntryPoints));
        if($pattern != null && $pattern != "") {
            $this->appEntryPoint = $configEntryPoints[$pattern];
            $this->appRequestType = $this->setAppRequestType($pattern,$configEntryPointsArray);
        }

    }

    public function getEntryPoint(): string {
        if($this->appEntryPoint == null) {
            $this->setEntryPoint();
        }
        $entryPoints = $this->config->getEntryPoints();
        return $this->appEntryPoint ?? reset($entryPoints);
    }

    public function setDefaultRequest():void {
        //TODO:: set this to the home path (index.php) it's the front controllers job to decide which controller/data it sends back
    }

    private function setAppRequestType(string $pattern, array $entryPointsArray) {
        if(array_key_exists($pattern,$entryPointsArray['WEB'])) return RequestTypeEnum::WEB;
        if(array_key_exists($pattern,$entryPointsArray['API'])) return RequestTypeEnum::API;
        if(array_key_exists($pattern,$entryPointsArray['AJAX'])) return RequestTypeEnum::AJAX;
        return RequestTypeEnum::UNKNOWN;

    }


    public function getAppRequestType() {
       return $this->appRequestType;
    }

    public function getRequestMethod() {
        return $this->requestMethod;
    }

    public function getRequestData() {
        $this->requestDataParser->parseData();
        return $this->requestDataParser->getParsedData();
    }

}
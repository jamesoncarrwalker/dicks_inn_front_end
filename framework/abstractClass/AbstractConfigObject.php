<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/04/2020
 * Time: 14:50
 */

namespace abstractClass;


use interfaces\ConfigInterface;
use interfaces\FileParseInterface;


abstract class AbstractConfigObject implements ConfigInterface, FileParseInterface {

    protected $configFileContents;
    protected $fileReader;

    public function __construct(FileParseInterface $fileReader) {
        $this->fileReader = $fileReader;
        $this->parseFile();
    }

    public function getDataSourceDetails() : array {
        if(!isset($this->configFileContents)) $this->parseFile();
        return $this->configFileContents['DATA_SOURCE'];
    }

    public function getConfigPaths() : array {
        if(!isset($this->configFileContents)) $this->parseFile();
        return $this->configFileContents['CONFIG_PATH'];
    }

    public function getEntryPoints() : array {
        if(!isset($this->configFileContents)) $this->parseFile();
        return $this->configFileContents['ENTRY_POINT'];
    }

    public function getServerRoots() : array {
        if(!isset($this->configFileContents)) $this->parseFile();
        return $this->configFileContents['SERVER_ROOT'];
    }

    public function getErrorHandler() : string {
        if(!isset($this->configFileContents)) $this->parseFile();
        $errorHandler = $this->configFileContents['ERROR_HANDLER'] ?? null;
        return (!isset($errorHandler) || !file_exists($errorHandler)) ? "" : $errorHandler;
    }

    public function setFile(string $fileName) {
        $this->configFileContents = null;
        $this->fileReader->setFile($fileName);
        $this->parseFile();
    }

}
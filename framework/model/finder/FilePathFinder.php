<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/04/2020
 * Time: 15:22
 */

namespace model\finder;


use abstractClass\AbstractFinder;


class FilePathFinder extends AbstractFinder {

    private $filePath;
    private $fileName;
    private $dirPath;

    function __construct(string $fileName, $dirPath = null) {
        $this->fileName = $fileName;
        $this->dirPath = $dirPath;
    }

    public function isValid() : bool {
        if(!isset($this->filePath)) {
            $this->runSearch();
        }
        return file_exists($this->filePath);

    }

    public function runSearch():void {

        if(isset($this->dirPath)) {
           $this->filePath = $this->dirPath . DIRECTORY_SEPARATOR . $this->fileName;
        } else {
            $this->filePath = $this->fileName;
        }

        if(!$this->isValid()) {
           throw new \Exception("File " . $this->filePath . " does not exist.  Have you set it correctly?");
        }

    }

    public function getResult() {
        if(!isset($this->filePath)) {
            $this->runSearch();
        }
        return $this->filePath??false;
    }


    public function setParams(string $fileName, $dirPath = null):void {
        $this->filePath = null;
        $this->fileName = $fileName;
        $this->dirPath = $dirPath;
    }
}
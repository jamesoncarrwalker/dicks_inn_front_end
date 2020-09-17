<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/04/2020
 * Time: 14:52
 */

namespace model\object\config;


use abstractClass\AbstractConfigObject;

class IniConfigObject extends AbstractConfigObject {

    public function parseFile() : bool {
        $this->configFileContents = $this->fileReader->parseFile();
       return is_array($this->configFileContents) && count($this->configFileContents) > 0;
    }

    public function getConfigFileType(): string {
        return '.ini';
    }

    public function getDefaultTitle() {
        if(!isset($this->configFileContents)) $this->parseFile();
        return $this->configFileContents['TITLE']??$_SERVER['REQUEST_URI'];
    }
}
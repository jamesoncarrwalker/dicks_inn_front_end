<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 03/04/2020
 * Time: 15:28
 */

namespace model\object\config;


use abstractClass\AbstractConfigObject;


class JsonConfigObject extends AbstractConfigObject {

    public function parseFile() : bool {
        $this->configFileContents = $this->fileReader->parseFile();
        return is_array($this->configFileContents) && count($this->configFileContents) > 0;
    }

    public function getConfigFileType(): string {
        return '.json';
    }

    public function getDefaultTitle() {
        if(!isset($this->configFileContents)) $this->parseFile();
        return $this->configFileContents['TITLE']??$_SERVER['REQUEST_URI'];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/04/2020
 * Time: 14:28
 */

namespace interfaces;


interface ConfigInterface {

    public function getDataSourceDetails() : array;

    public function getConfigPaths() : array;

    public function getEntryPoints() : array;

    public function getServerRoots() : array;

    public function getErrorHandler() : string;

    public function getConfigFileType(): string;



}
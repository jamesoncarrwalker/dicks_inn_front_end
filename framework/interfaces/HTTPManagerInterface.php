<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/03/2020
 * Time: 18:24
 */

namespace interfaces;


interface HTTPManagerInterface {

    public function parseUri():void;

    public function getUriStringForApp(): string;

    public function setEntryPoint():void;

    public function getEntryPoint():string;

    public function setRequestMethod():void;

    public function getRequestData();

    public function getAppRequestType();

    public function getRequestMethod();

}
<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 27/05/2020
 * Time: 19:41
 */

namespace interfaces;


interface UrlRouteInterface {

    public function getRouteString():string;

    public function getEntryPattern(): string;
}
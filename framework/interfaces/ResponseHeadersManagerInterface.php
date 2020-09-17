<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 15:48
 */

namespace interfaces;


interface ResponseHeadersManagerInterface {

    public function setHeaders();

    public function setHeader(string $name,$value);

    public function getHeaders():array;

    public function clearHeaders();

    public function clearHeader(string $name);

}
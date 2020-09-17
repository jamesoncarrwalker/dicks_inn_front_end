<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 19:29
 */

namespace interfaces;


interface FinderInterface {


    /**
     * @param string $searchQuery
     * @param null $optionalParam
     * @return mixed
     */
    public function setParams(string $searchQuery, $optionalParam = null):void;

    /**
     * @return mixed
     */
    public function runSearch():void;

    /**
     * @return mixed
     */
    public function getResult();

}
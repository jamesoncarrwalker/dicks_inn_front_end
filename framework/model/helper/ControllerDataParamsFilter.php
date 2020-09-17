<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 24/05/2020
 * Time: 07:13
 */

namespace model\helper;


class ControllerDataParamsFilter {

    public static function getControllerDataParams(string $routePattern, array $data, string $openTag = '[', string $closeTag = ']',string $delimiter = '/') :array {


        if(count($data) == 0) {
            return $data;
        }

        $explodedString = explode($delimiter,$routePattern);

        foreach($explodedString as $routeSection) {
            if(strpos($routeSection,$openTag) === false && strpos($routeSection,$closeTag) === false ) {
                $index = array_search($routeSection,$data);
                if($index !== false) {
                   unset($data[$index]);
                }
            }
        }
        $controllerParams = [];
        foreach($data as $key => $value) {
            if(is_int($key)) {
                $controllerParams[] = $value;
            }

        }

        return $controllerParams;


    }
}
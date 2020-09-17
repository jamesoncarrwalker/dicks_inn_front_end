<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/10/2019
 * Time: 09:14
 */

namespace interfaces;


interface AuthenticatorInterface {

    public function getAuthLevel();

    public function checkAuthLevel(string $minimumRequired):bool;
}
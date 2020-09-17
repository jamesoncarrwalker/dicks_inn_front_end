<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 08/05/2020
 * Time: 21:06
 */

namespace model\authenticator;


use interfaces\AuthenticatorInterface;


class AuthenticatorApi implements AuthenticatorInterface {

    public function getAuthLevel() {
        // TODO: Implement getAuthLevel() method.
    }

    public function checkAuthLevel(string $minimumRequired):bool {
        // TODO: Implement checkAuthLevel() method.
    }
}
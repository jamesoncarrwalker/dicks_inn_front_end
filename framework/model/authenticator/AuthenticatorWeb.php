<?php
namespace model\authenticator;
use enum\AuthLevelEnum;
use interfaces\AuthenticatorInterface;
use interfaces\PersistentStateManagerInterface;


/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/10/2019
 * Time: 13:24
 */
class AuthenticatorWeb implements AuthenticatorInterface {

    public function __construct(PersistentStateManagerInterface $sessionManager, PersistentStateManagerInterface $cookieManager) {
        //::TODO Define authenticator web
    }

    public function getAuthLevel():int {
        // TODO: Implement getAuthLevel() method.
        if(isset($_SESSION['USER_LEVEL'])) {
            return AuthLevelEnum::getValueForConstant($_SESSION['USER_LEVEL']);
        } else return AuthLevelEnum::getValueForConstant(AuthLevelEnum::PUBLIC);
    }

    public function checkAuthLevel(string $minimumRequired):bool {
        $currentLevel = AuthLevelEnum::getValueForConstant($_SESSION['USER_LEVEL'] ?? AuthLevelEnum::PUBLIC);

        return $currentLevel >= $minimumRequired;
    }
}
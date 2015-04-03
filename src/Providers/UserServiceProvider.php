<?php


namespace App\Providers;

use App\Entities\User;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserServiceProvider
 * @package App\Providers
 */
class UserServiceProvider implements UserProviderInterface, ServiceProviderInterface
{
    public function loadUserByUsername($username)
    {
        /**
         * search user in database
         * code below is dummy
         */

        if (! $username === "admin") {
            throw new \InvalidArgumentException("invalid token");
        }

        $user = new User();
        $user->setUsername("admin");
        $user->setRoles(["ROLE_ADMIN"]);

        return $user;
    }

    /**
     * @param UserInterface $user
     * @return User
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return void
     */
    public function supportsClass($class)
    {
        return;
    }

    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container["users"] = function () {
            return $this;
        };
    }
}


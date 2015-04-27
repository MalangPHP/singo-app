<?php

namespace App\Modules\User;

use App\Modules\User\EventSourcing\Listeners\LogLogin;
use App\Modules\User\Handlers\UserHandler;
use App\Modules\User\Commands\LoginCommand;
use App\Modules\User\Providers\UserServiceProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\EventListenerProviderInterface;
use Silex\Application;
use Singo\Application as Singo;
use Singo\Contracts\Module\CommandHandlerProviderInterface;
use Singo\Contracts\Module\ModuleInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class Module
 * @package App\Modules\User
 */
class Module implements
    ModuleInterface,
    ServiceProviderInterface,
    CommandHandlerProviderInterface,
    EventListenerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getName()
    {
        return "User Module";
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        /**
         * register user service provider
         */
        $container->register(new UserServiceProvider());
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(Container $container, EventDispatcherInterface $dispatcher)
    {
        if (! $container instanceof Singo) {
            throw new \InvalidArgumentException("Container must be instance of " . Singo::class);
        }

        /**
         * register login log subscriber
         */
        $container->registerSubscriber(LogLogin::class, function () use ($container) {
            return new LogLogin($container["monolog"]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function command(Application $application)
    {
        /**
         * register login command and handler
         */
        $application->registerCommands(
            [
                LoginCommand::class
            ],
            function () use ($application) {
                return new UserHandler($application["security.jwt.encoder"], $application["dispatcher"]);
            }
        );
    }
}

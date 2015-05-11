<?php

namespace App\Modules\User\Handlers;

use App\Modules\User\Commands\LoginCommand;
use App\Modules\User\EventSourcing\Events\AfterLoginEvent;
use App\Modules\User\Exceptions\InvalidUsernamePasswordException;
use Silex\Component\Security\Core\Encoder\JWTEncoder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class UserHandler
 * @package App\Modules\User\Handlers
 */
class UserHandler
{
    /**
     * @var JWTEncoder
     */
    protected $encoder;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param JWTEncoder $encoder
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(JWTEncoder $encoder, EventDispatcherInterface $dispatcher)
    {
        $this->encoder = $encoder;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param LoginCommand $command
     * @return string
     */
    public function handleLoginCommand(LoginCommand $command)
    {
        if ($command->getUsername() == "admin" && $command->getPassword() == "singo") {
            /**
             * notify all AfterLoginEvent subscriber
             */
            $this->dispatcher->dispatch(AfterLoginEvent::EVENT, new AfterLoginEvent($command->getUsername()));

            return $this->encoder->encode(["name" => $command->getUsername()]);
        }

        throw new InvalidUsernamePasswordException("invalid username or password");
    }
}

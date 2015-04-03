<?php


namespace App\Modules\User\Handlers;

use App\Modules\User\Commands\LoginCommand;
use Silex\Component\Security\Core\Encoder\JWTEncoder;

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
     * @param JWTEncoder $encoder
     */
    public function __construct(JWTEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param LoginCommand $command
     * @return string
     */
    public function handleLoginCommand(LoginCommand $command)
    {
        if ($command->getUsername() == "admin" && $command->getPassword() == "singo") {
            return $this->encoder->encode(["name" => $command->getUsername()]);
        }

        throw new \InvalidArgumentException("invalid username or password");
    }
}


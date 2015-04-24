<?php

namespace App\Modules\User\Commands;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class LoginCommand
 * @package App\Modules\User\Commands
 */
class LoginCommand
{
    /**
     * @Assert\Length(min = 3)
     * @Assert\NotBlank
     * @var string
     */
    protected $username;

    /**
     * @Assert\Length(min = 3)
     * @Assert\NotBlank
     * @var string
     */
    protected $password;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

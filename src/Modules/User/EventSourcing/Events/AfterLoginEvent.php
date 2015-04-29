<?php

namespace App\Modules\User\EventSourcing\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class AfterLoginEvent
 * @package App\Modules\User\EventSourcing\Events
 */
class AfterLoginEvent extends Event
{
    const EVENT = "afterLoginEvent";

    /**
     * @var string $username
     */
    private $username;

    /**
     * @param string $username
     */
    public function __construct($username = "")
    {
        $this->username = $username;
    }

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
}

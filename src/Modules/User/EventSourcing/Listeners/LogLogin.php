<?php

namespace App\Modules\User\EventSourcing\Listeners;

use App\Modules\User\EventSourcing\Events\AfterLoginEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LogLogin
 * @package App\Modules\User\EventSourcing\Listeners
 */
class LogLogin implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            AfterLoginEvent::EVENT => ["onAfterLoginEvent", 0]
        ];
    }

    /**
     * @param AfterLoginEvent $event
     */
    public function onAfterLoginEvent(AfterLoginEvent $event)
    {
        $this->logger->info($event->getUsername() . "has been logged in successfully");
    }
}

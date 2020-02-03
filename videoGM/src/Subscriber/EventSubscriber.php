<?php
namespace App\Subscriber;

use App\Event\UserRegisteredEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class EventSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [UserRegisteredEvent::class => 'onUserRegisteredEvent'];
    }

    public function onUserRegisteredEvent(UserRegisteredEvent $event): void
    {
        $user= $event->getUser();
        $email = $user->getEmail();

        if($event->getUser()) {

            $this->logger->info(
                'Utilisateur a bien été créé : mail : "'.$email." FirstName : ".$event->getUser()->getFirstName()." LastName: ".$event->getUser()->getLastName());

        }

    }
}
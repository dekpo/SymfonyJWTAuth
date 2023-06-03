<?php

namespace App\EventListener;

use App\Repository\UserRepository;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginEventListener
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        // Get the User freshly authentificated
        $user = $event->getAuthenticationToken()->getUser();
        // Update connectedAt
        $user->setConnectedAt(new \DateTime());      
        // Persist the data to database.
        $this->userRepository->save($user, true);
    }
}
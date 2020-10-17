<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedSubscriber
{
    public function updateJWTData(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        $data = $event->getData();
        $data['firstName']= $user->getFirstName();
        $data['lastName'] = $user->getLastName();

        $event->setData($data);
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function updateJWTTime(JWTCreatedEvent $event)
    {
        $expiration = new \DateTime('+1 day');
        
        $expiration->setTime(2, 0, 0);

        $payload        = $event->getData();
        $payload['exp'] = $expiration->getTimestamp();

        $event->setData($payload);        
    }
}
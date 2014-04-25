<?php

namespace WWII\Service\Provider\FlashMessenger;

class FlashMessengerFactory implements \WWII\Service\ServiceProviderFactoryInterface
{
    public function createService(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $service = new FlashMessenger($serviceManager);

        return $service;
    }
}

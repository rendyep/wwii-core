<?php

namespace WWII\Service\Provider\Session;

class SessionContainerFactory implements \WWII\Service\ServiceProviderFactoryInterface
{
    public function createService(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $service = new SessionContainer($serviceManager);

        return $service->getSessionStorage();
    }
}

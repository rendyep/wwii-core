<?php

namespace WWII\Service\Provider\Route;

class RouteManagerFactory implements \WWII\Service\ServiceProviderFactoryInterface
{
    public function createService(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $service = new RouteManager($serviceManager);

        return $service;
    }
}

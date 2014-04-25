<?php

namespace WWII\Service;

interface ServiceProviderFactoryInterface
{
    public function createService(ServiceManagerInterface $serviceManager);
}

<?php

namespace WWII\Service;

interface ServiceProviderInterface
{
    public function __construct(ServiceManagerInterface $serviceManager);
}

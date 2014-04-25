<?php

namespace WWII\Service\Provider\Template;

class TemplateManagerFactory implements \WWII\Service\ServiceProviderFactoryInterface
{
    public function createService(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $service = new TemplateManager($serviceManager);

        return $service;
    }
}

<?php

namespace WWII\Service\Provider\Mail;

class MailManagerFactory implements \WWII\Service\ServiceProviderFactoryInterface
{
    public function createService(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $service = new MailManager($serviceManager);

        return $service;
    }
}

<?php

namespace WWII\Service;

interface ServiceManagerInterface
{
    public function getInstance();

    public function setConfigManager(\WWII\Config\ConfigManagerInterface $configManager);

    public function getConfigManager();

    public function get($serviceName);
}

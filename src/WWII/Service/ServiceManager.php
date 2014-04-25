<?php

namespace WWII\Service;

class ServiceManager implements ServiceManagerInterface
{
    private static $instance;

    protected $configManager;

    protected static $services = array();

    public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ServiceManager();
        }

        return $this->serviceManager;
    }

    public function setConfigManager(\WWII\Config\ConfigManagerInterface $configManager)
    {
        $this->configManager = $configManager;
    }

    public function getConfigManager()
    {
        return $this->configManager;
    }

    public function get($serviceName)
    {
        if (!isset(self::$services[$serviceName]) || empty(self::$services[$serviceName])) {
            $serviceList = $this->configManager->get('service');

            if (empty($serviceList[$serviceName])) {
                throw new \Exception("Service dengan nama \"{$serviceName}\" tidak ditemukan!");
            }

            if (!isset(self::$services[$serviceName])) {
                $serviceFactory = new $serviceList[$serviceName]();
                self::$services[$serviceName] = $serviceFactory->createService($this);
            }
        }
        return self::$services[$serviceName];
    }
}

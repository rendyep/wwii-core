<?php

namespace WWII\Service\Provider\Session;

class SessionContainer implements \WWII\Service\ServiceProviderInterface
{
    protected $serviceManager;

    protected $configManager;

    protected $sessionStorage;

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->configManager = $serviceManager->getConfigManager();

        if (!isset($_SESSION[$this->configManager->get('session_id')])) {
            $_SESSION[$this->configManager->get('session_id')] = new SessionStorage();
        }

        $this->sessionStorage = $_SESSION[$this->configManager->get('session_id')];
    }

    public function getSessionStorage()
    {
        return $this->sessionStorage;
    }
}

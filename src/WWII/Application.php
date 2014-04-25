<?php

namespace WWII;

class Application
{
    protected $configManager;

    protected $serviceManager;

    protected $routeManager;

    protected $entityManager;

    public function __construct($module = null, $controller = null, $action = null)
    {
        $this->loadConfigManager();
        $this->loadServiceManager();
        $this->loadRouteManager($module, $controller, $action);
    }

    protected function loadConfigManager()
    {
        $this->configManager = \WWII\Config\ConfigManager::getInstance();
    }

    protected function loadServiceManager()
    {
        $this->serviceManager = new \WWII\Service\ServiceManager();
        $this->serviceManager->setConfigManager($this->configManager);
    }

    protected function loadRouteManager($module = null, $controller = null, $action = null)
    {
        $this->routeManager = $this->serviceManager->get('RouteManager');

        if (!empty($module) && !empty($controller) && !empty($action)) {
            $this->routeManager->setRoute($module, $controller, $action);
        }
    }

    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function run()
    {
        $moduleList = $this->configManager->get('module');

        if (!isset($moduleList[$this->routeManager->getModule(true)])) {
            $classPath = $moduleList['Index']['namespace']
                . $moduleList['Index']['controller']['Error']['class'];
        } else {
            $classPath = $moduleList[$this->routeManager->getModule(true)]['namespace']
                . $moduleList[$this->routeManager->getModule(true)]['controller'][$this->routeManager->getController(true)]['class'];
        }

        $controllerClass = new $classPath($this->serviceManager, $this->entityManager);
        $controllerClass->run();
    }
}

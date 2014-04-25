<?php

namespace WWII\Controller;

class AbstractController implements ControllerInterface
{
    protected $serviceManager;

    protected $entityManager;

    protected $routeManager;

    protected $sessionContainer;

    protected $templateManager;

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->serviceManager = $serviceManager;
        $this->entityManager = $entityManager;
        $this->routeManager = $serviceManager->get('RouteManager');
        $this->sessionContainer = $serviceManager->get('SessionContainer');
        $this->templateManager = $serviceManager->get('TemplateManager');
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
        $actionMethod = $this->routeManager->getAction(true) . 'Action';

        if (!method_exists($this, $actionMethod)) {
            throw new \Exception("Action \"{$actionMethod}\" tidak ditemukan!");
        }

        $this->$actionMethod();
    }
}

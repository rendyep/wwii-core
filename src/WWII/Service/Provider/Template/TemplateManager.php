<?php

namespace WWII\Service\Provider\Template;

class TemplateManager implements \WWII\Service\ServiceProviderInterface
{
    protected $serviceManager;

    protected $flashMessenger;

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->flashMessenger = $serviceManager->get('FlashMessenger');
    }

    public function renderHeader()
    {
        include('view/header.phtml');
    }

    public function renderFooter()
    {
        include('view/footer.phtml');
    }

    public function clean()
    {
        ob_end_clean();
    }
}

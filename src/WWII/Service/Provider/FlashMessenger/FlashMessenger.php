<?php

namespace WWII\Service\Provider\FlashMessenger;

class FlashMessenger implements \WWII\Service\ServiceProviderInterface
{
    protected $serviceManager;

    protected $messageContainer = array();

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->sessionContainer = $serviceManager->get('SessionContainer');

        if (empty($this->sessionContainer->messages)) {
            $this->sessionContainer->messages = $this->messageContainer;
        } else {
            $this->messageContainer = $this->sessionContainer->messages;
        }
    }

    public function addMessage($message)
    {
        $this->messageContainer[] = $message;

        $this->sessionContainer->messages = $this->messageContainer;
    }

    public function collectMessages()
    {
        $messages = $this->sessionContainer->messages;

        unset($this->sessionContainer->messages);

        return $messages;
    }
}

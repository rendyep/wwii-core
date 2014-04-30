<?php

namespace WWII\Service\Provider\Mail;

require_once 'Mail.php';

class MailManager implements \WWII\Service\ServiceProviderInterface
{
    protected $serviceManager;

    protected $configManager;

    protected $credential;

    protected $connection;

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->configManager = $serviceManager->getConfigManager();
        $this->credential = $this->configManager->get('mail');

        $this->getConnection();
    }

    public function getConnection()
    {
        if ($this->connection === null) {
            $this->connection = \Mail::factory('smtp', $this->credential);
        }

        return $connection;
    }

    public function send($to, $subject, $body)
    {
        $headers['From'] = $this->credential['username'];
        $headers['To'] = is_array($to) ? implode(',', $to) : $to;
        $headers['Subject'] = $subject;
        $headers['Date'] = date('r', time());

        $sender = $this->connection->send($to, $headers, $body);
        if (\PEAR::isError($sender)) {
            return false;
        }

        return true;
    }

    public function getError()
    {
        return $this->connection->getMessage();
    }
}

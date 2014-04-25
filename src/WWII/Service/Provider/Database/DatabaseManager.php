<?php

namespace WWII\Service\Provider\Database;

class DatabaseManager extends \PDO implements \WWII\Service\ServiceProviderInterface
{
    protected $serviceManager;

    protected $configManager;

    protected $databaseConfig;

    protected $query;

    protected $parameters;

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        $this->configManager = $this->serviceManager->getConfigManager();
        $this->databaseConfig = $this->configManager->get('database2');

        parent::__construct("sqlsrv:Server={$this->databaseConfig['host']};Database={$this->databaseConfig['dbname']};",
            $this->databaseConfig['user'], $this->databaseConfig['password']);
    }

    /**
     * @override
     */
    public function prepare($query, array $driver_options = array())
    {
        $this->query = $query;

        return parent::prepare($query);
    }

    /**
     * @override
     */
    public function execute(array $parameters = array())
    {
        $this->parameters = $parameters;

        return parent::execute($parameters);
    }

    /**
     * @override
     */
    public function query($query)
    {
        $this->query = $query;

        return parent::query($query);
    }

    public function getLastQuery()
    {
        return $this->query;
    }

    public function getLastParams()
    {
        return $this->parameters;
    }
}

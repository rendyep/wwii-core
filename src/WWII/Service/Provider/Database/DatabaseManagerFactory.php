<?php

namespace WWII\Service\Provider\Database;

class DatabaseManagerFactory implements \WWII\Service\ServiceProviderFactoryInterface
{
    public function createService(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $service = new DatabaseManager($serviceManager);
        $service->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $service->setAttribute(\PDO::SQLSRV_ATTR_ENCODING, \PDO::SQLSRV_ENCODING_UTF8);

        return $service;
    }
}

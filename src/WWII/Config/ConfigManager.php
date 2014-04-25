<?php

namespace WWII\Config;

class ConfigManager implements ConfigManagerInterface
{
    private static $instance;

    protected static $config = array();

    private function __construct()
    {
        self::$config = $this->loadConfigFiles();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ConfigManager();
        }

        return self::$instance;
    }

    private function loadConfigFiles()
    {
        $wwiiDir = __DIR__ . '/../../../../';

        if (file_exists($wwiiDir . 'core/config/config.default.php')) {
            $coreConfig = include($wwiiDir . 'core/config/config.default.php');
        }

        if (file_exists($wwiiDir . 'common/config/config.default.php')) {
            $commonConfig = include($wwiiDir . 'common/config/config.default.php');
        }

        if (file_exists($wwiiDir . 'domain/config/config.default.php')) {
            $domainConfig = include($wwiiDir . 'domain/config/config.default.php');
        }

        if (file_exists($wwiiDir . 'application/config/config.default.php')) {
            $applicationConfig = include($wwiiDir . 'application/config/config.default.php');
        }

        if (file_exists($wwiiDir . 'console/config/config.default.php')) {
            $consoleConfig = include($wwiiDir . 'console/config/config.default.php');
        }

        return array_merge($coreConfig, $commonConfig, $domainConfig, $applicationConfig, $consoleConfig);
    }

    public function get($configName)
    {
        if (empty(self::$config[$configName])) {
            throw new \Exception("Config dengan nama \"{$configName}\" tidak ditemukan!");
        }

        return self::$config[$configName];
    }
}

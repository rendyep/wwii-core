<?php

namespace WWII\Config;

interface ConfigManagerInterface
{
    public static function getInstance();

    public function get($configName);
}

<?php

$config = array(
    "database" => array(
        "driver" => "driver",
        "host" => "localhost",
        "user" => "username",
        "password" => "password",
        "dbname" => "database",
    ),

    "database2" => array(
        "driver" => "driver",
        "host" => "localhost",
        "user" => "username",
        "password" => "password",
        "dbname" => "database",
    ),

    "mail" => array(
        "host" => "ssl://localhost",
        "port" => "465",
        "auth" => true,
        "username" => "username@localhost",
        "password" => "password",
    ),

    "session_id" => "WWII_session_identifier",

    "service" => array(
        "RouteManager"
            => "\\WWII\Service\\Provider\\Route\\RouteManagerFactory",
        "DatabaseManager"
            => "\\WWII\Service\\Provider\\Database\\DatabaseManagerFactory",
        "SessionContainer"
            => "\\WWII\Service\\Provider\\Session\\SessionContainerFactory",
        "MailManager"
            => "\\WWII\Service\\Provider\\Mail\\MailManagerFactory",
        "TemplateManager"
            => "\\WWII\Service\\Provider\\Template\\TemplateManagerFactory",
        "FlashMessenger"
            => "\\WWII\Service\\Provider\\FlashMessenger\\FlashMessengerFactory",
    ),
);

if (file_exists(__DIR__ . '/config.sensitive.php')) {
    $config = array_merge($config, include(__DIR__ . '/config.sensitive.php'));
}

return $config;

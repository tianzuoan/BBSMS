<?php

require_once VENDOR_PATH.'/HJ100/autoloader.php';

$loader = new \Phalcon\Loader();


$loader->registerNamespaces([
    'BBSMS'=>LIBRARY_PATH.'/BBSMS/',
    'Aliyun'=>VENDOR_PATH.'/alibaba_sms/api_sdk/lib/'
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();


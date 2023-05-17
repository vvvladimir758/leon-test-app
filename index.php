<?php 
//setlocale(LC_ALL, 'ru_RU.utf8');
$loader = require __DIR__ . '/vendor/autoload.php';
//$loader->addPsr4('Acme\\Test\\', __DIR__);

session_start();

\Config\DatabaseConfig::init();

$app = new App\Controllers\ApplicationController();

$app->run();



?>
<?php
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__."\database");

var_dump($paths);
//exit();
$isDevMode = false;
$dbParams = array(
    'host'     => '127.0.0.1',
    'port'     => '3306',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'compras',
    'driver' => 'pdo_mysql',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, "data/proxies", null, false );


$entityManager = EntityManager::create($dbParams, $config);
$entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('_numeric', 'string');
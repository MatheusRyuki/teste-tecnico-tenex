<?php   
require __DIR__ . '/../vendor/autoload.php';

$paths = [
    realpath(__DIR__ . '/../src')
];

$openapi = \OpenApi\Generator::scan($paths);
header('Content-Type: application/json');
echo $openapi->toJson();

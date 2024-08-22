<?php   
require __DIR__ . '/../vendor/autoload.php';

/**
 * @OA\Info(
 *     title="API de Parcelas de Carnê",
 *     version="1.0.0"
 * )
 * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Servidor de Desenvolvimento"
 * )
 */

 $paths = [realpath(__DIR__ . '/../src'), realpath(__DIR__ . '/../app')];
 $openapi = \OpenApi\Generator::scan($paths);
 header('Content-Type: application/json');
 echo $openapi->toJson();
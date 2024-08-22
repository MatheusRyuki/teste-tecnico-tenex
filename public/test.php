<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * @OA\Info(
 *     title="API de Teste",
 *     version="1.0.0"
 * )
 */

/**
 * @OA\Get(
 *     path="/teste",
 *     summary="Endpoint de teste",
 *     @OA\Response(
 *         response=200,
 *         description="Resposta de teste"
 *     )
 * )
 */

$paths = [__DIR__];
$openapi = \OpenApi\Generator::scan($paths);
header('Content-Type: application/json');
echo $openapi->toJson();

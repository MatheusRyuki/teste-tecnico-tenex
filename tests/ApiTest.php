<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

class RoutesTest extends TestCase {
    public function testCreateCarneRoute() {
        $app = AppFactory::create();
        $app->group('/carne', require __DIR__ . '/../app/routes/carne.php');

        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $data = [
            'valor_total' => 1000.00,
            'qtd_parcelas' => 12,
            'data_primeiro_vencimento' => '2024-08-01',
            'periodicidade' => 'mensal',
            'valor_entrada' => 100.00
        ];

        $request = $requestFactory->createServerRequest('POST', '/carne')
                                  ->withParsedBody($data);
        $response = $responseFactory->createResponse();

        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testViewCarneRoute() {
        $app = AppFactory::create();
        $app->group('/carne', require __DIR__ . '/../app/routes/carne.php');

        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('GET', '/carne/1');
        $response = $responseFactory->createResponse();

        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}

<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;
use App\Application\Actions\Carne\ViewCarneAction;

class ViewCarneActionTest extends TestCase {
    public function testViewCarne() {
        $requestFactory = new ServerRequestFactory();
        $responseFactory = new ResponseFactory();

        $request = $requestFactory->createServerRequest('GET', '/carne/1');
        $response = $responseFactory->createResponse();

        $action = new ViewCarneAction();
        $response = $action($request, $response, ['id' => 1]);

        $responseBody = (string) $response->getBody();
        $carne = json_decode($responseBody, true);

        $this->assertEquals(1, $carne['id']);
        $this->assertEquals(100.00, $carne['valor_total']);
        $this->assertEquals(12, $carne['qtd_parcelas']);
        $this->assertEquals('2024-08-01', $carne['data_primeiro_vencimento']);
        $this->assertEquals('mensal', $carne['periodicidade']);
        $this->assertEquals(0, $carne['valor_entrada']);
    }
}

<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Factory\ResponseFactory;
use App\Application\Actions\Carne\CreateCarneAction;
use App\Models\Carne;

class CreateCarneActionTest extends TestCase {
    public function testCreateCarne() {
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

        $action = new CreateCarneAction();
        $response = $action($request, $response);

        $responseBody = (string) $response->getBody();
        $carne = json_decode($responseBody, true);

        $this->assertEquals(1000.00, $carne['valor_total']['amount']);
        $this->assertEquals(12, $carne['qtd_parcelas']);
        $this->assertEquals('2024-08-01', $carne['data_primeiro_vencimento']);
        $this->assertEquals('mensal', $carne['periodicidade']);
        $this->assertEquals(100.00, $carne['valor_entrada']['amount']);
    }
}

<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;

class CarneApiTest extends TestCase {
    public function testCreateCarne() {
        $app = AppFactory::create();
        $request = $this->createRequest('POST', '/carne', [
            'valor_total' => 100.00,
            'qtd_parcelas' => 12,
            'data_primeiro_vencimento' => '2024-08-01',
            'periodicidade' => 'mensal'
        ]);
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode((string) $response->getBody(), true);
        $this->assertEquals(100.00, $data['valor_total']);
    }

    private function createRequest($method, $uri, $data = []) {
        $request = \Slim\Psr7\Factory\ServerRequestFactory::createFromGlobals();
        $request = $request->withMethod($method)->withUri(new \Slim\Psr7\Uri('', '', 80, $uri));
        if (!empty($data)) {
            $request = $request->withParsedBody($data);
        }
        return $request;
    }
}
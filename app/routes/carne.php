<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as RouteCollectorProxy;

return function (RouteCollectorProxy $group) {
    $group->post('', function (Request $request, Response $response) {
        $data = $request->getParsedBody();

        $carne = new \App\Models\Carne(
            $data['valor_total'],
            $data['qtd_parcelas'],
            $data['data_primeiro_vencimento'],
            $data['periodicidade'],
            $data['valor_entrada'] ?? 0
        );
        $response->getBody()->write(json_encode($carne));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $group->get('/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];

        $mockResponse = [
            'id' => $id,
            'valor_total' => 100.00,
            'qtd_parcelas' => 12,
            'data_primeiro_vencimento' => '2024-08-01',
            'periodicidade' => 'mensal',
            'valor_entrada' => 0,
            'parcelas' => array_map(function ($numero) {
                return [
                    "data_vencimento" => date('Y-m-d', strtotime("+$numero month", strtotime('2024-08-01'))),
                    "valor" => "8.33",
                    "numero" => $numero,
                    "entrada" => false
                ];
            }, range(1, 12))
        ];
        $response->getBody()->write(json_encode($mockResponse));
        return $response->withHeader('Content-Type', 'application/json');
    });
};

<?php
declare(strict_types=1);

namespace App\Application\Actions\Carne;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/carne/{id}",
 *     summary="Obtém um carnê pelo ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalhes do carnê",
 *         @OA\JsonContent(ref="#/components/schemas/Carne")
 *     )
 * )
 */
class ViewCarneAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
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
    }
}

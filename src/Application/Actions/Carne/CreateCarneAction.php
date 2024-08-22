<?php
declare(strict_types=1);

namespace App\Application\Actions\Carne;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Carne;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API de Parcelas de Carnê",
 *     version="1.0.0",
 *     description="API para gerenciamento de parcelas de carnê."
 * )
 * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Servidor de Desenvolvimento"
 * )
 * @OA\Post(
 *     path="/carne",
 *     summary="Cria um novo carnê",
 *     description="Endpoint para criar um novo carnê com as informações fornecidas.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="valor_total", type="number", format="float", example=1000.00),
 *             @OA\Property(property="qtd_parcelas", type="integer", example=12),
 *             @OA\Property(property="data_primeiro_vencimento", type="string", format="date", example="2024-08-01"),
 *             @OA\Property(property="periodicidade", type="string", example="mensal"),
 *             @OA\Property(property="valor_entrada", type="number", format="float", example=100.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Carnê criado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Carne")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Dados inválidos fornecidos",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string", example="Dados inválidos fornecidos")
 *         )
 *     )
 * )
 */
class CreateCarneAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $carne = new Carne(
            $data['valor_total'],
            $data['qtd_parcelas'],
            $data['data_primeiro_vencimento'],
            $data['periodicidade'],
            $data['valor_entrada'] ?? 0
        );

        $response->getBody()->write(json_encode($carne));
        return $response->withHeader('Content-Type', 'application/json');
    }
}

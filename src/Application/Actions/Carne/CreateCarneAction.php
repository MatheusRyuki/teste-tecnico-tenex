<?php
declare(strict_types=1);

namespace App\Application\Actions\Carne;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Carne;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/carne",
 *     summary="Cria um novo carnê",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Carne")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Carnê criado com sucesso",
 *         @OA\JsonContent(ref="#/components/schemas/Carne")
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

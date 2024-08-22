<?php

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Parcela",
 *     type="object",
 *     title="Parcela",
 *     properties={
 *         @OA\Property(property="data_vencimento", type="string", format="date"),
 *         @OA\Property(property="valor", type="number", format="float"),
 *         @OA\Property(property="numero", type="integer"),
 *         @OA\Property(property="entrada", type="boolean")
 *     }
 * )
 */
class Parcela {
    public $data_vencimento;
    public $valor;
    public $numero;
    public $entrada;

    public function __construct($data_vencimento, $valor, $numero, $entrada = false) {
        $this->data_vencimento = $data_vencimento;
        $this->valor = $valor;
        $this->numero = $numero;
        $this->entrada = $entrada;
    }
}
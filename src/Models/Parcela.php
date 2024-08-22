<?php

namespace App\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Parcela",
 *     type="object",
 *     title="Parcela",
 *     description="Modelo que representa uma parcela do carnê",
 *     @OA\Property(property="data_vencimento", type="string", format="date", description="Data de vencimento da parcela"),
 *     @OA\Property(property="valor", type="number", format="float", description="Valor da parcela"),
 *     @OA\Property(property="numero", type="integer", description="Número da parcela"),
 *     @OA\Property(property="entrada", type="boolean", description="Indica se é a parcela de entrada")
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
<?php

namespace App\Models;

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
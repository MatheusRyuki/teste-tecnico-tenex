<?php
namespace App\Models;

use Brick\Money\Money;
use Brick\Money\Currency;
use Brick\Math\RoundingMode;

class Carne {
    public $valor_total;
    public $qtd_parcelas;
    public $data_primeiro_vencimento;
    public $periodicidade;
    public $valor_entrada;
    public $parcelas = [];

    public function __construct($valor_total, $qtd_parcelas, $data_primeiro_vencimento, $periodicidade, $valor_entrada = 0) {
        $this->valor_total = Money::of($valor_total, 'BRL');
        $this->qtd_parcelas = $qtd_parcelas;
        $this->data_primeiro_vencimento = $data_primeiro_vencimento;
        $this->periodicidade = $periodicidade;
        $this->valor_entrada = Money::of($valor_entrada, 'BRL');
        $this->calcularParcelas();
    }

    public function calcularParcelas() {
        $valor_restante = $this->valor_total->minus($this->valor_entrada);
        $valor_parcela = $valor_restante->dividedBy($this->qtd_parcelas, RoundingMode::HALF_UP);
        $data_vencimento = new \DateTime($this->data_primeiro_vencimento);

        if ($this->valor_entrada->isPositive()) {
            $this->parcelas[] = new Parcela($this->data_primeiro_vencimento, $this->valor_entrada->getAmount(), 1, true);
        }

        for ($i = 1; $i <= $this->qtd_parcelas; $i++) {
            if ($this->periodicidade === 'mensal') {
                $data_vencimento->modify('+1 month');
            } elseif ($this->periodicidade === 'semanal') {
                $data_vencimento->modify('+1 week');
            }
            $this->parcelas[] = new Parcela($data_vencimento->format('Y-m-d'), $valor_parcela->getAmount(), $i + ($this->valor_entrada->isPositive() ? 1 : 0));
        }
    }
}
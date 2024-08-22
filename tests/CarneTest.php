<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Carne;
use App\Models\Parcela;

class CarneTest extends TestCase {
    public function testCalculoParcelasSemEntrada() {
        $carne = new Carne(100.00, 12, '2024-08-01', 'mensal');
        $parcelas = $carne->parcelas;

        $this->assertCount(12, $parcelas);
        $this->assertEquals(8.33, $parcelas[0]->valor->toFloat());
        $this->assertEquals('2024-09-01', $parcelas[0]->data_vencimento);
    }

    public function testCalculoParcelasComEntrada() {
        $carne = new Carne(100.00, 12, '2024-08-01', 'mensal', 20.00);
        $parcelas = $carne->parcelas;

        $this->assertCount(13, $parcelas); // 12 parcelas + 1 entrada
        $this->assertEquals(20.00, $parcelas[0]->valor->toFloat());
        $this->assertEquals('2024-08-01', $parcelas[0]->data_vencimento);
        $this->assertEquals(6.67, $parcelas[1]->valor->toFloat());
        $this->assertEquals('2024-09-01', $parcelas[1]->data_vencimento);
    }

    public function testCalculoParcelasSemanal() {
        $carne = new Carne(100.00, 12, '2024-08-01', 'semanal');
        $parcelas = $carne->parcelas;

        $this->assertCount(12, $parcelas);
        $this->assertEquals(8.33, $parcelas[0]->valor->toFloat());
        $this->assertEquals('2024-08-08', $parcelas[0]->data_vencimento);
    }
}

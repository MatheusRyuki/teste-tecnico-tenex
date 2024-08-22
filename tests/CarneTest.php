<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Carne;

class CarneTest extends TestCase {
    public function testCalculoParcelas() {
        $carne = new Carne(100.00, 12, '2024-08-01', 'mensal');
        $parcelas = $carne->parcelas;

        $this->assertCount(12, $parcelas);
        $this->assertEquals(8.33, $parcelas[0]->valor);
        $this->assertEquals('2024-09-01', $parcelas[0]->data_vencimento);
    }
}
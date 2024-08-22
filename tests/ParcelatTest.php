<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Parcela;

class ParcelaTest extends TestCase {
    public function testParcelaConstructor() {
        $parcela = new Parcela('2024-08-01', 100.00, 1, true);

        $this->assertEquals('2024-08-01', $parcela->data_vencimento);
        $this->assertEquals(100.00, $parcela->valor);
        $this->assertEquals(1, $parcela->numero);
        $this->assertTrue($parcela->entrada);
    }
}

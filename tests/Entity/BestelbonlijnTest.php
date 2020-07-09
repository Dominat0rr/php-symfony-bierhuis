<?php

namespace App\Tests\Entity;

use App\Entity\Bestelbon;
use App\Entity\Bestelbonlijn;
use App\Entity\Bier;
use PHPUnit\Framework\TestCase;

class BestelbonlijnTest extends TestCase {
    protected $bestelbonlijn;
    protected $bestelbon;
    protected $bier;

    public function setUp() :void {
        $this->bier = new Bier();
        $this->bestelbon = new Bestelbon();
        $this->bestelbonlijn = new Bestelbonlijn();

        $this->bier->setNaam("Stella");
        $this->bestelbon->setNaam("johnnn15");
        $this->bestelbonlijn->setBier($this->bier);
        $this->bestelbonlijn->setBestelbon($this->bestelbon);
    }

    // Bestelbon
    /** @test */
    public function testBestelbonlijnHeeftBestelbonMetNaam_johnnn15_AlsBestelbon() {
        $this->assertEquals($this->bestelbonlijn->getBestelbon()->getNaam(), "johnnn15");
    }


    // Bier
    /** @test */
    public function testBestelbonlijnHeeftBierMetNaam_Stella_AlsBestelbon() {
        $this->assertEquals($this->bestelbonlijn->getBier()->getNaam(), "Stella");
    }

    // Aantal
    /** @test */
    public function testAantalEqualsTo10() {
        $this->bestelbonlijn->setAantal(10);

        $this->assertEquals($this->bestelbonlijn->getAantal(), 10);
    }

    /** @test */
    public function testsetAantalThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbonlijn->setAantal(null);
    }

    /** @test */
    public function testsetAantalMoetPositiefZijn() {
        $this->expectException(\Exception::class);

        $this->bestelbonlijn->setAantal(-1);
    }


    // Prijs
    /** @test */
    public function testPrijsqualsTo5() {
        $this->bestelbonlijn->setPrijs(5);

        $this->assertEquals($this->bestelbonlijn->getPrijs(), 5);
    }

    /** @test */
    public function testSetPrijsThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbonlijn->setPrijs(null);
    }

    /** @test */
    public function testSetPrijsMetNegatiefThrowsException() {
        $this->expectException(\Exception::class);

        $this->bestelbonlijn->setPrijs(0);
    }

    /** @test */
    public function testSetPrijsMet0ThrowsException() {
        $this->expectException(\Exception::class);

        $this->bestelbonlijn->setPrijs(0);
    }
}

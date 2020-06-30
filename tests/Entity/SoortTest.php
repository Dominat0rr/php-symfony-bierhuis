<?php

namespace App\Tests\Entity;

use App\Entity\Bier;
use App\Entity\Soort;
use PHPUnit\Framework\TestCase;

class SoortTest extends TestCase
{
    protected $soort;
    protected $bier;

    public function setUp() :void {
        $this->soort = new Soort();
        $this->bier = new Bier();

        $this->soort->setNaam("Pils");
        $this->bier->setNaam("Star blond");
        $this->soort->addBier($this->bier);
    }

    // Naam
    /** @test */
    public function testNaamEqualsToPils() {
        $this->soort->setNaam("Pils");

        $this->assertEquals($this->soort->getNaam(), "Pils");
    }

    /** @test */
    public function testSetNaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->soort->setNaam("");
    }

    /** @test */
    public function testSetNaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->soort->setNaam(null);
    }

    /** @test */
    public function testSetNaamTrimsInput() {
        $this->soort->setNaam("Pils     ");

        $this->assertEquals($this->soort->getNaam(), "Pils");
    }


    // Bier
    /** @test */
    public function testSoortHeeftBierInBierCollectie() {
        $this->assertTrue($this->soort->getBier()->contains($this->bier));
        $this->assertCount(1, $this->soort->getBier());
        //$this->assertIsArray($this->soort->getBier());
    }

    /** @test */
    public function testSetSoortAlsNullThrowsException() {
        $this->expectException(\TypeError::class);

        $this->soort->addBier(null);
    }
}

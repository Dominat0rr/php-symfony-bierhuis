<?php

namespace App\Tests\Entity;

use App\Entity\Bier;
use App\Entity\Brouwer;
use App\Entity\Soort;
use PHPUnit\Framework\TestCase;

class BierTest extends TestCase
{
    protected $soort;
    protected $brouwer;
    protected $bier;

    public function setUp() :void {
        $this->soort = new Soort();
        $this->brouwer = new Brouwer();
        $this->bier = new Bier();

        $this->soort->setNaam("Alcoholarm");
        $this->brouwer->setNaam("Roman");
//        $this->bier->setSoort($this->soort);
//        $this->bier->setBrouwer($this->brouwer);
        $this->soort->addBier($this->bier);
        $this->brouwer->addBier($this->bier);
    }

    // Naam
    /** @test */
    public function testNaamEqualsToAlfri() {
        $this->bier->setNaam("Alfri");

        $this->assertEquals($this->bier->getNaam(), "Alfri");
    }

    /** @test */
    public function testSetNaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->bier->setNaam("");
    }

    /** @test */
    public function testSetNaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->bier->setNaam(null);
    }

    /** @test */
    public function testSetNaamTrimsInput() {
        $this->bier->setNaam("     Alfri     ");

        $this->assertEquals($this->bier->getNaam(), "Alfri");
    }


    // Brouwer
    /** @test */
    public function testBierHeeftRomanAlsBrouwer() {
        $this->assertEquals($this->bier->getBrouwer()->getNaam(), "Roman");
    }

    /** @test */
    public function testSetBrouwerAlsNullThrowsException() {
        $this->expectException(\TypeError::class);

        $this->bier->setBrouwer(null);
    }

    // Soort
    /** @test */
    public function testBierHeeftAlcoholarmAlsSoort() {
        $this->assertEquals($this->bier->getSoort()->getNaam(), "Alcoholarm");
    }

    /** @test */
    public function testSetSoortAlsNullThrowsException() {
        $this->expectException(\TypeError::class);

        $this->bier->setSoort(null);
    }


    // alcohol
    /** @test */
    public function testAlcoholEqualsTo10() {
        $this->bier->setAlcohol("10");

        $this->assertEquals($this->bier->getAlcohol(), "10");
    }

    /** @test */
    public function testAlcoholThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->bier->setAlcohol(null);
    }

    /** @test */
    public function testSetAlcoholWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->bier->setAlcohol("");
    }

    /** @test */
    public function testSetAlcoholTrimsInput() {
        $this->bier->setAlcohol("     7     ");

        $this->assertEquals($this->bier->getAlcohol(), "7");
    }


    // prijs
    /** @test */
    public function testPrijsqualsTo5() {
        $this->bier->setPrijs(5);

        $this->assertEquals($this->bier->getPrijs(), 5);
    }

    /** @test */
    public function testSetPrijsThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->bier->setPrijs(null);
    }

    /** @test */
    public function testSetPrijsMetNegatiefThrowsException() {
        $this->expectException(\Exception::class);

        $this->bier->setPrijs(0);
    }

    /** @test */
    public function testSetPrijsMet0ThrowsException() {
        $this->expectException(\Exception::class);

        $this->bier->setPrijs(0);
    }


    // besteld
    /** @test */
    public function testBesteldEqualsTo1000() {
        $this->bier->setBesteld(1000);

        $this->assertEquals($this->bier->getBesteld(), 1000);
    }

    /** @test */
    public function testsetBesteldThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->bier->setBesteld(null);
    }

    /** @test */
    public function testsetBesteldMoetPositiefZijn() {
        $this->expectException(\Exception::class);

        $this->bier->setBesteld(-1);
    }
}

<?php

namespace App\Tests\Entity;

use App\Entity\Bier;
use App\Entity\Brouwer;
use PHPUnit\Framework\TestCase;

class BrouwerTest extends TestCase {
    protected $brouwer;
    protected $bier;

    public function setUp() :void {
        $this->brouwer = new Brouwer();
        $this->bier = new Bier();

        $this->bier->setNaam("Pils");
    }

    // Naam
    /** @test */
    public function testNaamEqualsToStella() {
        $this->brouwer->setNaam("Stella");

        $this->assertEquals($this->brouwer->getNaam(), "Stella");
    }

    /** @test */
    public function testSetNaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->brouwer->setNaam("");
    }

    /** @test */
    public function testSetNaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->brouwer->setNaam(null);
    }

    /** @test */
    public function testSetNaamTrimsInput() {
        $this->brouwer->setNaam("Stella     ");

        $this->assertEquals($this->brouwer->getNaam(), "Stella");
    }


    // Straatnaam
    /** @test */
    public function testStraatEqualsToLaan() {
        $this->brouwer->setStraat("Laan");

        $this->assertEquals($this->brouwer->getStraat(), "Laan");
    }

    /** @test */
    public function testSetStraatWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->brouwer->setStraat("");
    }

    /** @test */
    public function testSetStraatWithNull() {
        $this->expectException(\TypeError::class);

        $this->brouwer->setStraat(null);
    }

    /** @test */
    public function testSetStraatTrimsInput() {
        $this->brouwer->setStraat("Laan     ");

        $this->assertEquals($this->brouwer->getStraat(), "Laan");
    }


    // HuisNummer
    /** @test */
    public function testHuisnummerEqualsTo14A() {
        $this->brouwer->setHuisNr("14A");

        $this->assertEquals($this->brouwer->getHuisNr(), "14A");
    }

    /** @test */
    public function testSetHuisNrWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->brouwer->setHuisNr("");
    }

    /** @test */
    public function testSetHuisNrWithNull() {
        $this->expectException(\TypeError::class);

        $this->brouwer->setHuisNr(null);
    }

    /** @test */
    public function testSetHuisNrTrimsInput() {
        $this->brouwer->setHuisNr("     141     ");

        $this->assertEquals($this->brouwer->getHuisNr(), "141");
    }


    // postcode
    /** @test */
    public function testPostcodeEqualsTo1000() {
        $this->brouwer->setPostcode(1000);

        $this->assertEquals($this->brouwer->getPostcode(), 1000);
    }

    /** @test */
    public function testPostcodeThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->brouwer->setPostcode(null);
    }

    /** @test */
    public function testPostcodeMoetGroterAls1000Zijn() {
        $this->expectException(\Exception::class);

        $this->brouwer->setPostcode(999);
    }

    /** @test */
    public function testPostcodeMoetKleinerAls9999Zijn() {
        $this->expectException(\Exception::class);

        $this->brouwer->setPostcode(10000);
    }

    /** @test */
    public function testPostcodeMoetPositiefZijn() {
        $this->expectException(\Exception::class);

        $this->brouwer->setPostcode(-1);
    }


    // gemeente
    /** @test */
    public function testGeementeEqualsToAntwerpen() {
        $this->brouwer->setGemeente("Antwerpen");

        $this->assertEquals($this->brouwer->getGemeente(), "Antwerpen");
    }

    /** @test */
    public function testSetGemeenteWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->brouwer->setGemeente("");
    }

    /** @test */
    public function testSetGemeenteWithNull() {
        $this->expectException(\TypeError::class);

        $this->brouwer->setGemeente(null);
    }

    /** @test */
    public function testSetGemeenteTrimsInput() {
        $this->brouwer->setGemeente("     Antwerpen     ");

        $this->assertEquals($this->brouwer->getGemeente(), "Antwerpen");
    }


    // omzet
    /** @test */
    public function testOmzetEqualsTo100000() {
        $this->brouwer->setOmzet(100000);

        $this->assertEquals($this->brouwer->getOmzet(), 100000);
    }

    /** @test */
    public function testOmzetThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->brouwer->setOmzet(null);
    }

    /** @test */
    public function testOmzetMoetPositiefZijn() {
        $this->expectException(\Exception::class);

        $this->brouwer->setOmzet(-1);
    }


    // Bier
    /** @test */
    public function testBrouwerHeeftBierInBierCollectie() {
        $this->brouwer->addBier($this->bier);

        $this->assertTrue($this->brouwer->getBier()->contains($this->bier));
        $this->assertCount(1, $this->brouwer->getBier());
    }

    /** @test */
    public function testSetBrouwerAlsNullThrowsException() {
        $this->expectException(\TypeError::class);

        $this->brouwer->addBier(null);
    }
}

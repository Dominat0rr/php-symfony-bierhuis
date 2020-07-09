<?php

namespace App\Tests\Entity;

use App\Entity\Bestelbon;
use App\Entity\Bestelbonlijn;
use PHPUnit\Framework\TestCase;

class BestelbonTest extends TestCase {
    protected $bestelbon;
    protected $bestelbonlijn;

    public function setUp() :void {
        $this->bestelbon = new Bestelbon();
        $this->bestelbonlijn = new Bestelbonlijn();

        $this->bestelbon->setNaam("Johnn15");
        $this->bestelbon->addBestelbonlijn($this->bestelbonlijn);
    }

    // naam (gebruikersnaam)
    /**
     * @test
     */
    public function testNaamEqualsTo_Johnn15() {
        $this->bestelbon->setNaam("Johnn15");

        $this->assertEquals($this->bestelbon->getNaam(), "Johnn15");
    }

    /** @test */
    public function testSetNaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setNaam("");
    }

    /** @test */
    public function testSetNaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbon->setNaam(null);
    }

    /** @test */
    public function testSetNaamTrimsInput() {
        $this->bestelbon->setNaam("     Johnn15     ");

        $this->assertEquals($this->bestelbon->getNaam(), "Johnn15");
    }


    // straat
    /**
     * @test
     */
    public function testStraatEqualsToTeststraat() {
        $this->bestelbon->setStraat("Teststraat");

        $this->assertEquals($this->bestelbon->getStraat(), "Teststraat");
    }

    /** @test */
    public function testSetStraatWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setStraat("");
    }

    /** @test */
    public function testSetStraatWithNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbon->setStraat(null);
    }

    /** @test */
    public function testSetStraatTrimsInput() {
        $this->bestelbon->setStraat("     Teststraat     ");

        $this->assertEquals($this->bestelbon->getStraat(), "Teststraat");
    }


    // huisnummer
    /**
     * @test
     */
    public function testHuisnrEqualsTo14A() {
        $this->bestelbon->setHuisnr("14A");

        $this->assertEquals($this->bestelbon->getHuisnr(), "14A");
    }

    /** @test */
    public function testSetHuisnrWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setHuisnr("");
    }

    /** @test */
    public function testSetHuisnrWithNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbon->setHuisnr(null);
    }

    /** @test */
    public function testSetHuisnrTrimsInput() {
        $this->bestelbon->setHuisnr("     1041     ");

        $this->assertEquals($this->bestelbon->getHuisnr(), "1041");
    }


    // postcode
    /** @test */
    public function testPostcodeEqualsTo1000() {
        $this->bestelbon->setPostcode(1000);

        $this->assertEquals($this->bestelbon->getPostcode(), 1000);
    }

    /** @test */
    public function testPostcodeThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbon->setPostcode(null);
    }

    /** @test */
    public function testPostcodeMoetGroterAls1000Zijn() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setPostcode(999);
    }

    /** @test */
    public function testPostcodeMoetKleinerAls9999Zijn() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setPostcode(10000);
    }

    /** @test */
    public function testPostcodeMoetPositiefZijn() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setPostcode(-1);
    }


    // gemeente
    /** @test */
    public function testGeementeEqualsToAntwerpen() {
        $this->bestelbon->setGemeente("Antwerpen");

        $this->assertEquals($this->bestelbon->getGemeente(), "Antwerpen");
    }

    /** @test */
    public function testSetGemeenteWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->bestelbon->setGemeente("");
    }

    /** @test */
    public function testSetGemeenteWithNull() {
        $this->expectException(\TypeError::class);

        $this->bestelbon->setGemeente(null);
    }

    /** @test */
    public function testSetGemeenteTrimsInput() {
        $this->bestelbon->setGemeente("     Antwerpen     ");

        $this->assertEquals($this->bestelbon->getGemeente(), "Antwerpen");
    }


    // bestelbonlijn
    /** @test */
    public function testBestelbonHeeftBestelbonlijnAlsBestelbonlijn() {
        $this->assertTrue($this->bestelbon->getBestelbonlijn()->contains($this->bestelbonlijn));
        $this->assertCount(1, $this->bestelbon->getBestelbonlijn());
    }

    /** @test */
    public function testAddBestelbonlijnAlsNullThrowsException() {
        $this->expectException(\TypeError::class);

        $this->bestelbon->addBestelbonlijn(null);
    }

    /** @test */
    public function testremoveBestelbonlijn() {
        $this->bestelbon->removeBestelbonlijn($this->bestelbonlijn);
        $this->assertFalse($this->bestelbon->getBestelbonlijn()->contains($this->bestelbonlijn));
        $this->assertCount(0, $this->bestelbon->getBestelbonlijn());
    }
}

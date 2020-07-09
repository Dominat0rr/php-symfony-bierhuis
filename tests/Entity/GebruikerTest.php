<?php

namespace App\Tests\Entity;

use App\Entity\Gebruiker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GebruikerTest extends TestCase {
    protected $gebruiker;

    public function setUp() :void {
        $this->gebruiker = new Gebruiker();
    }

    // voornaam
    /**
     * @test
     */
    public function testVoornaamEqualsToJohn() {
        $this->gebruiker->setVoornaam("John");

        $this->assertEquals($this->gebruiker->getVoornaam(), "John");
    }

    /** @test */
    public function testSetVoornaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setVoornaam("");
    }

    /** @test */
    public function testSetVoornaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setVoornaam(null);
    }

    /** @test */
    public function testSetVoornaamTrimsInput() {
        $this->gebruiker->setVoornaam("     John     ");

        $this->assertEquals($this->gebruiker->getVoornaam(), "John");
    }


    // familienaam
    /**
     * @test
     */
    public function testFamilienaamEqualsToJohn() {
        $this->gebruiker->setFamilienaam("Doe");

        $this->assertEquals($this->gebruiker->getFamilienaam(), "Doe");
    }

    /** @test */
    public function testSetFamilienaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setFamilienaam("");
    }

    /** @test */
    public function testSetFamilienaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setFamilienaam(null);
    }

    /** @test */
    public function testSetFamilienaamTrimsInput() {
        $this->gebruiker->setFamilienaam("     Doe     ");

        $this->assertEquals($this->gebruiker->getFamilienaam(), "Doe");
    }


    // straat
    /**
     * @test
     */
    public function testStraatEqualsToJohn() {
        $this->gebruiker->setStraat("Street");

        $this->assertEquals($this->gebruiker->getStraat(), "Street");
    }

    /** @test */
    public function testSetStraatWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setStraat("");
    }

    /** @test */
    public function testSetStraatWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setStraat(null);
    }

    /** @test */
    public function testSetStraatTrimsInput() {
        $this->gebruiker->setStraat("     Street     ");

        $this->assertEquals($this->gebruiker->getStraat(), "Street");
    }


    // huisnr
    /**
     * @test
     */
    public function testHuisnrEqualsToJohn() {
        $this->gebruiker->setHuisnr("14A");

        $this->assertEquals($this->gebruiker->getHuisnr(), "14A");
    }

    /** @test */
    public function testSetHuisnrWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setHuisnr("");
    }

    /** @test */
    public function testSetHuisnrWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setHuisnr(null);
    }

    /** @test */
    public function testSetHuisnrTrimsInput() {
        $this->gebruiker->setHuisnr("     14A     ");

        $this->assertEquals($this->gebruiker->getHuisnr(), "14A");
    }


    // postcode
    /** @test */
    public function testPostcodeEqualsTo1000() {
        $this->gebruiker->setPostcode(1000);

        $this->assertEquals($this->gebruiker->getPostcode(), 1000);
    }

    /** @test */
    public function testPostcodeThrowsExceptionOnNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setPostcode(null);
    }

    /** @test */
    public function testPostcodeMoetGroterAls1000Zijn() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setPostcode(999);
    }

    /** @test */
    public function testPostcodeMoetKleinerAls9999Zijn() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setPostcode(10000);
    }

    /** @test */
    public function testPostcodeMoetPositiefZijn() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setPostcode(-1);
    }


    // gemeente
    /** @test */
    public function testGeementeEqualsToAntwerpen() {
        $this->gebruiker->setGemeente("Antwerpen");

        $this->assertEquals($this->gebruiker->getGemeente(), "Antwerpen");
    }

    /** @test */
    public function testSetGemeenteWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setGemeente("");
    }

    /** @test */
    public function testSetGemeenteWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setGemeente(null);
    }

    /** @test */
    public function testSetGemeenteTrimsInput() {
        $this->gebruiker->setGemeente("     Antwerpen     ");

        $this->assertEquals($this->gebruiker->getGemeente(), "Antwerpen");
    }


    // gebruikersnaam
    /** @test */
    public function testGebruikersnaamEqualsToJohnn15() {
        $this->gebruiker->setGebruikersnaam("Johnn15");

        $this->assertEquals($this->gebruiker->getGebruikersnaam(), "Johnn15");
    }

    /** @test */
    public function testSetGebruikersnaamWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setGebruikersnaam("");
    }

    /** @test */
    public function testSetGebruikersnaamWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setGebruikersnaam(null);
    }

    /** @test */
    public function testSetGebruikersnaamTrimsInput() {
        $this->gebruiker->setGebruikersnaam("     Johnn15     ");

        $this->assertEquals($this->gebruiker->getGebruikersnaam(), "Johnn15");
    }

    // password
    /**
     * @test
     */
    public function testPasswordEqualsTo_Test123_Encoded() {
        $this->gebruiker->setPassword(password_hash("Test123", PASSWORD_ARGON2I));

        $this->assertTrue(password_verify("Test123", $this->gebruiker->getPassword()));
    }

    /** @test */
    public function testSetPasswordWithEmptyString() {
        $this->expectException(\Exception::class);

        $this->gebruiker->setPassword("");
    }

    /** @test */
    public function testSetPasswordWithNull() {
        $this->expectException(\TypeError::class);

        $this->gebruiker->setPassword(null);
    }

    /** @test */
    public function testSetPasswordTrimsInput() {
        $this->gebruiker->setPassword("     Johnn15     ");

        $this->assertEquals($this->gebruiker->getPassword(), "Johnn15");
    }
}

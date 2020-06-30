<?php

namespace App\Tests\Entity;

use App\Entity\Soort;
use PHPUnit\Framework\TestCase;

class SoortTest extends TestCase
{
    protected $soort;

    public function setUp() :void {
        $this->soort = new Soort();
    }

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
}

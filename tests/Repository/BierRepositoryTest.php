<?php

namespace App\Tests\Repository;

use BierRepository;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class BierRepositoryTest extends TestCase
{
    /** @test */
    public function testGetAantalBieren() {
        $aantalBieren = 0;

        // Mock the repository so it returns the mock of bier
        $bierRepository = $this->createMock(ObjectRepository::class);
        // use getMock() on PHPUnit 5.3 or below
//        $bierRepository = $this->getMock(ObjectRepository::class);

        $bierRepository->expects($this->any())
            ->method('countAantalBieren')
            ->willReturn($aantalBieren);

        // Last, mock the EntityManager to return the mock of the repository
        // (this is not needed if the class being tested injects the
        // repository it uses instead of the entire object manager)
        $objectManager = $this->createMock(ObjectManager::class);
        // use getMock() on PHPUnit 5.3 or below
//        $objectManager = $this->getMock(ObjectManager::class);

        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($bierRepository);

        $this->assertEquals(1186, $aantalBieren);
    }
}

<?php

namespace App\Entity;

use App\Repository\BierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BierRepository::class)
 */
class Bier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=100)
     */
    private $naam;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity=Brouwer::class, inversedBy="bier")
     */
    private $brouwer;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="App\Entity\Soort", inversedBy="bier")
     */
    private $soort;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $alcohol;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prijs;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="integer")
     */
    private $besteld = 0;

    private $aantal = 0;

    public function __construct()
    {
        $this->brouwer = new ArrayCollection();
        $this->soort = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        if (empty($naam)) throw new \Exception("Kan niet null zijn");

        $this->naam = trim($naam);

        return $this;
    }

    public function getBrouwer(): ?Brouwer
    {
        return $this->brouwer;
    }

    public function setBrouwer(?Brouwer $brouwer): self
    {
        if ($brouwer == null) throw new \TypeError("Kan niet null zijn");

        $this->brouwer = $brouwer;

        return $this;
    }

    public function getSoort(): ?Soort
    {
        return $this->soort;
    }

    public function setSoort(?Soort $soort): self
    {
        if ($soort == null) throw new \TypeError("Kan niet null zijn");

        $this->soort = $soort;

        return $this;
    }

    public function getAlcohol(): ?string
    {
        return $this->alcohol;
    }

    public function setAlcohol(string $alcohol): self
    {
        if (empty($alcohol)) throw new \Exception();

        $this->alcohol = trim($alcohol);

        return $this;
    }

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(string $prijs): self
    {
        if ($prijs <= 0) throw new \Exception("Prijs moet groter als 0 zijn");

        $this->prijs = $prijs;

        return $this;
    }

    public function getBesteld(): ?int
    {
        return $this->besteld;
    }

    public function setBesteld(int $besteld): self
    {
        if ($besteld < 0) throw new \Exception("Aantal mag niet negatief zijn");

        $this->besteld = $besteld;

        return $this;
    }

    public function getAantal(): int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): void
    {
        $this->aantal = $aantal;
    }

    public function __toString()
    {
        return $this->naam;
    }
}

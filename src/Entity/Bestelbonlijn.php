<?php

namespace App\Entity;

use App\Repository\BestelbonlijnRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BestelbonlijnRepository::class)
 */
class Bestelbonlijn
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bestelbon::class, inversedBy="bestelbonlijn")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bestelbon;

    /**
     * @ORM\ManyToOne(targetEntity=Bier::class, inversedBy="bestelbonlijn")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bier;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $aantal;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prijs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBestelbon(): ?Bestelbon
    {
        return $this->bestelbon;
    }

    public function setBestelbon(?Bestelbon $bestelbon): self
    {
        $this->bestelbon = $bestelbon;

        return $this;
    }

    public function getBier(): ?Bier
    {
        return $this->bier;
    }

    public function setBier(?Bier $bier): self
    {
        $this->bier = $bier;

        return $this;
    }

    public function getAantal(): int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): void
    {
        if ($aantal < 0) throw new \Exception("Aantal mag niet negatief zijn");

        $this->aantal = $aantal;
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
}

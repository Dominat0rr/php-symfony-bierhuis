<?php

namespace App\Entity;

use App\Repository\BestelbonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BestelbonRepository::class)
 */
class Bestelbon
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
     * @ORM\Column(type="string", length=50)
     */
    private $naam;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=50)
     */
    private $straat;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=50)
     */
    private $huisnr;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="smallint")
     */
    private $postcode;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=50)
     */
    private $gemeente;

    /**
     * @ORM\OneToMany(targetEntity=Bestelbonlijn::class, mappedBy="bestelbon")
     */
    private $bestelbonlijn;

    public function __construct()
    {
        $this->bestelbonlijn = new ArrayCollection();
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
        if (empty($naam)) throw new \Exception();

        $this->naam = trim($naam);

        return $this;
    }

    public function getStraat(): ?string
    {
        return $this->straat;
    }

    public function setStraat(string $straat): self
    {
        if (empty($straat)) throw new \Exception();

        $this->straat = trim($straat);

        return $this;
    }

    public function getHuisnr(): ?string
    {
        return $this->huisnr;
    }

    public function setHuisnr(string $huisnr): self
    {
        if (empty($huisnr)) throw new \Exception();

        $this->huisnr = trim($huisnr);

        return $this;
    }

    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    public function setPostcode(int $postcode): self
    {
        if ($postcode < 1000 || $postcode > 9999) throw new \Exception("Postcode moet tussen 1000 & 9999 liggen");

        $this->postcode = $postcode;

        return $this;
    }

    public function getGemeente(): ?string
    {
        return $this->gemeente;
    }

    public function setGemeente(string $gemeente): self
    {
        if (empty($gemeente)) throw new \Exception();

        $this->gemeente = trim($gemeente);

        return $this;
    }

    /**
     * @return Collection|Bestelbonlijn[]
     */
    public function getBestelbonlijn(): Collection
    {
        return $this->bestelbonlijn;
    }

    public function addBestelbonlijn(Bestelbonlijn $bestelbonlijn): self
    {
        if (!$this->bestelbonlijn->contains($bestelbonlijn)) {
            $this->bestelbonlijn[] = $bestelbonlijn;
            $bestelbonlijn->setBestelbon($this);
        }

        return $this;
    }

    public function removeBestelbonlijn(Bestelbonlijn $bestelbonlijn): self
    {
        if ($this->bestelbonlijn->contains($bestelbonlijn)) {
            $this->bestelbonlijn->removeElement($bestelbonlijn);
            // set the owning side to null (unless already changed)
            if ($bestelbonlijn->getBestelbon() === $this) {
                $bestelbonlijn->setBestelbon(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->naam;
    }
}

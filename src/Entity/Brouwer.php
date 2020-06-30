<?php

namespace App\Entity;

use App\Repository\BrouwerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BrouwerRepository::class)
 */
class Brouwer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
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
    private $huisNr;

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
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
     */
    private $omzet;

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

    public function getHuisNr(): ?string
    {
        return $this->huisNr;
    }

    public function setHuisNr(string $huisNr): self
    {
        if (empty($huisNr)) throw new \Exception("Huisnummer mag niet leeg zijn");

        $this->huisNr = trim($huisNr);

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

    public function getOmzet(): ?int
    {
        return $this->omzet;
    }

    public function setOmzet(?int $omzet): self
    {
        if ($omzet == null) throw new \TypeError("Kan niet null zijn");
        if ($omzet < 0) throw new \Exception("Omzet kan niet negatief zijn");

        $this->omzet = $omzet;

        return $this;
    }
}

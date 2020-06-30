<?php

namespace App\Entity;

use App\Repository\SoortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SoortRepository::class)
 */
class Soort
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
     * @ORM\OneToMany(targetEntity="App\Entity\Bier", mappedBy="soort")
     */
    private $bier;

    public function __construct() {
        $this->bier = new ArrayCollection();
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

    /**
     * @return Collection|Bier[]
     */
    public function getBier(): Collection
    {
        return $this->bier;
    }

    public function addBier(Bier $bier): self
    {
        if (!$this->bier->contains($bier)) {
            $this->bier[] = $bier;
            $bier->setSoort($this);
        }

        return $this;
    }

    public function removeBier(Bier $bier): self
    {
        if ($this->bier->contains($bier)) {
            $this->bier->removeElement($bier);
            // set the owning side to null (unless already changed)
            if ($bier->getSoort() === $this) {
                $bier->setSoort(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->naam;
    }
}

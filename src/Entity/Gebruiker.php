<?php

namespace App\Entity;

use App\Repository\GebruikerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GebruikerRepository::class)
 */
class Gebruiker implements UserInterface
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
    private $voornaam;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=50)
     */
    private $familienaam;

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
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $gebruikersnaam;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGebruikersnaam(): ?string
    {
        return (string) $this->gebruikersnaam;
    }

    public function setGebruikersnaam(string $gebruikersnaam): self
    {
        if (empty($gebruikersnaam)) throw new \Exception();

        $this->gebruikersnaam = trim($gebruikersnaam);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    /**
     * @param mixed $voornaam
     */
    public function setVoornaam(string $voornaam): self
    {
        if (empty($voornaam)) throw new \Exception();

        $this->voornaam = trim($voornaam);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFamilienaam(): ?string
    {
        return $this->familienaam;
    }

    /**
     * @param mixed $familienaam
     */
    public function setFamilienaam(string $familienaam): self
    {
        if (empty($familienaam)) throw new \Exception();

        $this->familienaam = trim($familienaam);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStraat(): ?string
    {
        return $this->straat;
    }

    /**
     * @param mixed $straat
     */
    public function setStraat(string $straat): self
    {
        if (empty($straat)) throw new \Exception();

        $this->straat = trim($straat);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHuisnr(): ?string
    {
        return $this->huisnr;
    }

    /**
     * @param mixed $huisnr
     */
    public function setHuisnr(string $huisnr): self
    {
        if (empty($huisnr)) throw new \Exception();

        $this->huisnr = trim($huisnr);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode(int $postcode): self
    {
        if ($postcode < 1000 || $postcode > 9999) throw new \Exception("Postcode moet tussen 1000 & 9999 liggen");

        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGemeente(): ?string
    {
        return $this->gemeente;
    }

    /**
     * @param mixed $gemeente
     */
    public function setGemeente(string $gemeente): self
    {
        if (empty($gemeente)) throw new \Exception();

        $this->gemeente = trim($gemeente);

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->gebruikersnaam;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        if (empty($password)) throw new \Exception();

        $this->password = trim($password);

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}

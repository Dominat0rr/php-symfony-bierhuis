<?php


namespace App\Service;


use App\Entity\Gebruiker;
use App\Repository\GebruikerRepository;

class GebruikerService implements GebruikerServiceInterface {
    private $gebruikerRepository;

    public function __construct(GebruikerRepository $gebruikerRepository) {
        $this->gebruikerRepository = $gebruikerRepository;
    }

    public function save(Gebruiker $gebruiker) {
        $this->gebruikerRepository->save($gebruiker);
    }
}
<?php


namespace App\Service;


use App\Entity\Gebruiker;

interface GebruikerServiceInterface {
    public function save(Gebruiker $gebruiker);
}
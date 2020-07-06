<?php


namespace App\Service;


use App\Entity\Bestelbonlijn;

interface BestelbonlijnServiceInterface {
    public function save(Bestelbonlijn $bestelbonlijn);
}
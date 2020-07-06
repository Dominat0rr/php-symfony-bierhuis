<?php


namespace App\Service;


use App\Entity\Bestelbonlijn;
use App\Repository\BestelbonlijnRepository;

class BestelbonlijnService implements BestelbonlijnServiceInterface {
    private $bestelbonlijnRepository;

    public function __construct(BestelbonlijnRepository $bestelbonRepository) {
        $this->bestelbonlijnRepository = $bestelbonRepository;
    }

    public function save(Bestelbonlijn $bestelbonlijn) {
        $this->bestelbonlijnRepository->save($bestelbonlijn);
    }
}
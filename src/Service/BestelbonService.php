<?php


namespace App\Service;


use App\Entity\Bestelbon;
use App\Repository\BestelbonRepository;

class BestelbonService implements BestelbonServiceInterface {
    private $bestelbonRepository;

    public function __construct(BestelbonRepository $bestelbonRepository) {
        $this->bestelbonRepository = $bestelbonRepository;
    }

    public function save(Bestelbon $bestelbon) {
        $this->bestelbonRepository->save($bestelbon);
    }
}
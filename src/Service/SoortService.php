<?php


namespace App\Service;


use App\Repository\SoortRepository;

class SoortService implements SoortServiceInterface {
    private $soortRepository;

    public function __construct(SoortRepository $soortRepository) {
        $this->soortRepository = $soortRepository;
    }

    public function findAll() {
        return $this->soortRepository->findAll();
    }

    public function findById(?int $id) {
        return $this->soortRepository->find($id);
    }


}
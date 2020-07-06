<?php


namespace App\Service;


use App\Repository\BrouwerRepository;

class BrouwerService implements BrouwerServiceInterface {
    private $brouwerRepository;

    public function __construct(BrouwerRepository $brouwerRepository) {
        $this->brouwerRepository = $brouwerRepository;
    }

    public function findAll() {
        return $this->brouwerRepository->findAll();
    }

    public function findById(?int $id) {
        return $this->brouwerRepository->find($id);
    }


}
<?php


namespace App\Service;


use App\Entity\Bier;
use App\Repository\BierRepository;

class BierService implements BierServiceInterface {
    private $bierRepository;

    public function __construct(BierRepository $bierRepository) {
        $this->bierRepository = $bierRepository;
    }

    public function update(Bier $bier) {
        $this->bierRepository->update($bier);
    }

    public function getAantal() {
        return $this->bierRepository->getAantal();
    }

    public function findAll() {
        return $this->bierRepository->findAll();
    }

    public function findById(?int $id) {
        return $this->bierRepository->find($id);
    }

    public function findAllWithPagination(?int $limit, ?int $offset) {
        return $this->bierRepository->findAllWithPaginated($limit, $offset);
    }
}
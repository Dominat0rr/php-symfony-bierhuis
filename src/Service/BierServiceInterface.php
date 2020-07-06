<?php


namespace App\Service;


use App\Entity\Bier;

interface BierServiceInterface {
    public function update(Bier $bier);
    public function getAantal();
    public function findAll();
    public function findById(?int $id);
    public function findAllWithPagination(?int $limit, ?int $offset);
}
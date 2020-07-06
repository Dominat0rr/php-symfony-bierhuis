<?php


namespace App\Service;


interface SoortServiceInterface {
    public function findAll();
    public function findById(?int $id);
}
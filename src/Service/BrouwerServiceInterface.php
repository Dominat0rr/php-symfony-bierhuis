<?php


namespace App\Service;


interface BrouwerServiceInterface {
    public function findAll();
    public function findById(?int $id);
}
<?php


namespace App\Service;


use App\Entity\Bestelbon;

interface BestelbonServiceInterface {
    public function save(Bestelbon $bestelbon);

}
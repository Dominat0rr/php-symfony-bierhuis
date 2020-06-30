<?php

namespace App\Controller;

use App\Entity\Bier;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bieren", name="bieren.")
 */
class BierController extends AbstractController
{
    /**
     * @Route("/", name="bieren")
     * @param BrouwerRepository $brouwerRepository
     * @param BierRepository $bierRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BrouwerRepository $brouwerRepository, BierRepository $bierRepository)
    {
        $brouwers = $brouwerRepository->findAll();
        $bieren = $bierRepository->findAll();

        return $this->render('bier/index.html.twig', [
            "brouwers" => $brouwers,
            "bieren" => $bieren
        ]);
    }

    /**
     * @Route("/bier/{id}", name="bier")
     * @param BrouwerRepository $brouwerRepository
     * @param Bier $bier
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bier(BrouwerRepository $brouwerRepository, Bier $bier) {
        $brouwers = $brouwerRepository->findAll();

        return $this->render("bier/bier.html.twig", [
            "brouwers" => $brouwers,
            "bier" => $bier,
        ]);
    }
}

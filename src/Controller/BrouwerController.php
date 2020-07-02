<?php

namespace App\Controller;

use App\Entity\Brouwer;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/brouwers", name="brouwers.")
 */
class BrouwerController extends AbstractController
{
    /**
     * @Route("/", name="brouwers")
     * @param BrouwerRepository $brouwerRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BrouwerRepository $brouwerRepository)
    {
        $brouwers = $brouwerRepository->findAll();

        return $this->render('brouwer/index.html.twig', [
            "brouwers" => $brouwers
        ]);
    }

    /**
     * @Route("/brouwer/{id}", defaults={"id"=null}, name="brouwer")
     * @param BrouwerRepository $brouwerRepository
     * @param BierRepository $bierRepository
     * @param Brouwer $brouwer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function brouwer(BrouwerRepository $brouwerRepository, BierRepository $bierRepository, Brouwer $brouwer = null) {
        $brouwers = $brouwerRepository->findAll();
        //$bieren = $bierRepository->findByBrouwer($brouwer->getId());

        if ($brouwer === null) {
            return $this->render("brouwer/brouwer.html.twig", [
                "brouwers" => $brouwers,
                "brouwer" => $brouwer
            ]);
        }

        $bieren = $brouwer->getBier()->getValues();

        return $this->render("brouwer/brouwer.html.twig", [
            "brouwers" => $brouwers,
            "bieren" => $bieren,
            "brouwer" => $brouwer
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Soort;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use App\Repository\SoortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soorten", name="soorten.")
 */
class SoortController extends AbstractController
{
    /**
     * @Route("/", name="soorten")
     * @param BrouwerRepository $brouwerRepository
     * @param SoortRepository $soortRepository
     * @return Response
     */
    public function index(BrouwerRepository $brouwerRepository, SoortRepository $soortRepository)
    {
        $brouwers = $brouwerRepository->findAll();
        $soorten = $soortRepository->findAll();

        return $this->render('soort/index.html.twig', [
            "brouwers" => $brouwers,
            "soorten" => $soorten
        ]);
    }

    /**
     * @Route("/soort/{id}", defaults={"id"=null}, name="soort")
     * @param BrouwerRepository $brouwerRepository
     * @param Soort $soort
     * @return Response
     */
    public function soort(BrouwerRepository $brouwerRepository, BierRepository $bierRepository, Soort $soort = null) {
        $brouwers = $brouwerRepository->findAll();

        if ($soort === null) {
            return $this->render("soort/soort.html.twig", [
                "brouwers" => $brouwers,
                "soort" => $soort
            ]);
        }

        //$bieren = $bierRepository->findBySoort($soort->getId());
        $bieren = $soort->getBier()->getValues();

        return $this->render("soort/soort.html.twig", [
            "brouwers" => $brouwers,
            "bieren" => $bieren,
            "soort" => $soort
        ]);
    }
}

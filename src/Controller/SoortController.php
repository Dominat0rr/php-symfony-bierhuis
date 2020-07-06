<?php

namespace App\Controller;

use App\Entity\Soort;
use App\Service\BrouwerService;
use App\Service\SoortService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soorten", name="soorten.")
 */
class SoortController extends AbstractController
{
    private $soortService;
    private $brouwerService;

    /**
     * SoortController constructor.
     * @param SoortService $soortService
     * @param BrouwerService $brouwerService
     */
    public function __construct(SoortService $soortService, BrouwerService $brouwerService) {
        $this->soortService = $soortService;
        $this->brouwerService = $brouwerService;
    }

    /**
     * @Route("/", name="soorten")
     * @return Response
     */
    public function index()
    {
        $brouwers = $this->brouwerService->findAll();
        $soorten = $this->soortService->findAll();

        return $this->render('soort/index.html.twig', [
            "brouwers" => $brouwers,
            "soorten" => $soorten
        ]);
    }

    /**
     * @Route("/soort/{id}", defaults={"id"=null}, name="soort")
     * @param Soort $soort
     * @return Response
     */
    public function soort(Soort $soort = null) {
        $brouwers = $this->soortService->findAll();

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

<?php

namespace App\Controller;

use App\Service\BierService;
use App\Service\BrouwerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $brouwerService;
    private $bierService;

    /**
     * MainController constructor.
     * @param BrouwerService $brouwerService
     * @param BierService $bierService
     */
    public function __construct(BrouwerService $brouwerService, BierService $bierService) {
        $this->brouwerService = $brouwerService;
        $this->bierService = $bierService;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index()
    {
//        $em = $this->getDoctrine()->getManager();
//        $qb = $em->createQueryBuilder();
//        $qb->select($qb->expr()->count('b'))
//            ->from(Bier::class, 'b');
//        $query = $qb->getQuery();
//        $aantalBieren = $query->getSingleScalarResult();

        $brouwers = $this->brouwerService->findAll();
        $aantalBieren = $this->bierService->getAantal();

        return $this->render('home/index.html.twig', [
            "brouwers" => $brouwers,
            "aantalBieren" => $aantalBieren
        ]);
    }
}

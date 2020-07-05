<?php

namespace App\Controller;

use App\Entity\Bier;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use App\Service\BierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param BrouwerRepository $brouwerRepository
     * @param BierRepository $bierRepository
     * @return Response
     */
    public function index(BrouwerRepository $brouwerRepository, BierRepository $bierRepository)
    {
//        $em = $this->getDoctrine()->getManager();
//        $qb = $em->createQueryBuilder();
//        $qb->select($qb->expr()->count('b'))
//            ->from(Bier::class, 'b');
//        $query = $qb->getQuery();
//        $aantalBieren = $query->getSingleScalarResult();

        $brouwers = $brouwerRepository->findAll();
        $aantalBieren = $bierRepository->getAantal();

        return $this->render('home/index.html.twig', [
            "brouwers" => $brouwers,
            "aantalBieren" => $aantalBieren
        ]);
    }
}

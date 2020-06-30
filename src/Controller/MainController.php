<?php

namespace App\Controller;

use App\Entity\Bier;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BrouwerRepository $brouwerRepository)
    {
        $brouwers = $brouwerRepository->findAll();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select($qb->expr()->count('b'))
            ->from(Bier::class, 'b');
        $query = $qb->getQuery();
        $aantalBieren = $query->getSingleScalarResult();

        return $this->render('home/index.html.twig', [
            "brouwers" => $brouwers,
            "aantalBieren" => $aantalBieren
        ]);
    }
}

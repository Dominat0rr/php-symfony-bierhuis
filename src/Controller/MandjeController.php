<?php

namespace App\Controller;

use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("/mandje", name="mandje.")
 */
class MandjeController extends AbstractController
{
    /**
     * @Route("/", name="mandje")
     * @param BrouwerRepository $brouwerRepository
     * @param BierRepository $bierRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BrouwerRepository $brouwerRepository, BierRepository $bierRepository, Request $request)
    {
        $brouwers = $brouwerRepository->findAll();

        $bieren = [];
        //$bieren_mandje = array(4 => "2", 7 => "10");
        $session = $request->getSession();
        //$session->set("cart", $bieren_mandje);
        $bieren_mandje = $session->get("cart");

        foreach ($bieren_mandje as $key => $value) {
            $id = $key;
            $aantal = $value;

            $bier = $bierRepository->find($id);
            $bier->setAantal($aantal);
            array_push($bieren, $bier);
        }

        return $this->render('mandje/index.html.twig', [
            "brouwers" => $brouwers,
            "bieren" => $bieren
        ]);
    }
}

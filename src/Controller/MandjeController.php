<?php

namespace App\Controller;

use App\Repository\BierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mandje", name="mandje.")
 */
class MandjeController extends AbstractController
{
    /**
     * @Route("/", name="mandje")
     * @param BierRepository $bierRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BierRepository $bierRepository, Request $request)
    {
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
            "bieren" => $bieren
        ]);
    }
}

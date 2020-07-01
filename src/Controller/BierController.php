<?php

namespace App\Controller;

use App\Entity\Bier;
use App\Form\BierAantalFormType;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param BrouwerRepository $brouwerRepository
     * @param Bier $bier
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bier(Request $request, BrouwerRepository $brouwerRepository, Bier $bier) {
        $brouwers = $brouwerRepository->findAll();

        $form = $this->createForm(BierAantalFormType::class, $bier);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //$bier_mandje = array($request->attributes->get("id") => $request->get("bier_aantal_form")["aantal"]);
            $session = $request->getSession();
            $cartElements = $session->get("cart");
            $cartElements[$request->attributes->get("id")] = $request->get("bier_aantal_form")["aantal"];
            $session->set("cart", $cartElements);

            $this->addFlash("succes", "Bier \"" . $bier->getNaam() . "\" is succesvol toegevoegd aan uw mandje");
            return $this->redirect($this->generateUrl("mandje.mandje"));
        }

        return $this->render("bier/bier.html.twig", [
            "brouwers" => $brouwers,
            "bier" => $bier,
            "form" => $form->createView()
        ]);
    }
}
